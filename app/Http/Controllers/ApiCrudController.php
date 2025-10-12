<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class ApiCrudController extends Controller
{
    private function cfg(string $slug): array {
        $cfg = config("api_groups.groups.$slug");
        abort_unless($cfg, 404, 'Kelompok tidak ditemukan.');
        return $cfg;
    }
    private function endpoint(array $cfg): string {
        return rtrim($cfg['base_url'], '/') . ($cfg['path'] ?? '');
    }
    private function headers(array $cfg, string $action): array {
        $auth   = !empty($cfg['token']) ? ['Authorization' => 'Bearer '.$cfg['token']] : [];
        $common = $cfg['headers']['common'] ?? [];
        $extra  = $cfg['headers']['by_action'][$action] ?? [];
        return array_merge($auth, $common, $extra);
    }

    public function page(string $slug) {
        $cfg = $this->cfg($slug);
        return view('api_mgmt.page', ['slug'=>$slug, 'title'=>$cfg['name'] ?? strtoupper($slug)]);
    }

    public function index(string $slug) {
        $cfg = $this->cfg($slug);
        $resp = Http::withHeaders($this->headers($cfg,'list'))
                    ->get($this->endpoint($cfg), $cfg['list_params'] ?? ['action'=>'list']);
        if ($resp->failed()) return response()->json(['ok'=>false,'message'=>$resp->body()], $resp->status());
        $json = $resp->json();
        $rows = is_array($json) ? (Arr::isAssoc($json) && isset($json['data']) ? $json['data'] : $json) : [];
        return response()->json(['ok'=>true,'data'=>$rows]);
    }

    public function store(Request $r, string $slug) {
        $cfg = $this->cfg($slug);
        $payload = $r->validate(['nama'=>'required|string|max:255','deskripsi'=>'nullable|string']);
        $headers = $this->headers($cfg,'create');
        $asJson  = strtolower($headers['Content-Type'] ?? '') === 'application/json';
        $resp = Http::withHeaders($headers)->when($asJson, fn($h)=>$h->asJson())
            ->withQueryParameters($cfg['actions']['create'] ?? ['action'=>'create'])
            ->post($this->endpoint($cfg), $payload);
        if ($resp->failed()) return response()->json(['ok'=>false,'message'=>$resp->body()], $resp->status());
        return response()->json(['ok'=>true,'data'=>$resp->json()]);
    }

    public function update(Request $r, string $slug, $id) {
        $cfg = $this->cfg($slug);
        $payload = $r->validate(['nama'=>'required|string|max:255','deskripsi'=>'nullable|string']);
        $headers = $this->headers($cfg,'update');
        $asJson  = strtolower($headers['Content-Type'] ?? '') === 'application/json';
        $body  = array_merge(['_method'=>'PUT'], $payload);
        $query = array_merge($cfg['actions']['update'] ?? ['action'=>'update'], ['id'=>$id]);
        $resp = Http::withHeaders($headers)->when($asJson, fn($h)=>$h->asJson())
            ->withQueryParameters($query)->post($this->endpoint($cfg), $body);
        if ($resp->failed()) return response()->json(['ok'=>false,'message'=>$resp->body()], $resp->status());
        return response()->json(['ok'=>true,'data'=>$resp->json()]);
    }

    public function destroy(string $slug, $id) {
        $cfg = $this->cfg($slug);
        $headers = $this->headers($cfg,'delete');
        $asJson  = strtolower($headers['Content-Type'] ?? '') === 'application/json';
        $body  = ['_method'=>'DELETE'];
        $query = array_merge($cfg['actions']['delete'] ?? ['action'=>'delete'], ['id'=>$id]);
        $resp = Http::withHeaders($headers)->when($asJson, fn($h)=>$h->asJson())
            ->withQueryParameters($query)->post($this->endpoint($cfg), $body);
        if ($resp->failed()) return response()->json(['ok'=>false,'message'=>$resp->body()], $resp->status());
        return response()->json(['ok'=>true,'data'=>$resp->json()]);
    }
}
