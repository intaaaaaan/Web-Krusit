@extends('layouts.app')
@section('title', $title)
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="max-w-5xl mx-auto py-10 px-4">
  <h1 class="text-2xl font-bold mb-2">{{ $title }}</h1>
  <p class="text-gray-600 mb-6">CRUD via proxy Laravel untuk <b>{{ $slug }}</b>.</p>

  <div class="border rounded-xl p-4 mb-6">
    <form id="item-form" onsubmit="return submitForm(event)">
      <input type="hidden" id="editingId">
      <div class="grid md:grid-cols-2 gap-4">
        <div><label class="text-sm">Nama</label><input id="nama" class="mt-1 w-full border rounded px-3 py-2" required></div>
        <div><label class="text-sm">Deskripsi</label><input id="deskripsi" class="mt-1 w-full border rounded px-3 py-2"></div>
      </div>
      <div class="mt-4 flex gap-3">
        <button id="submitBtn" class="px-4 py-2 rounded bg-gray-900 text-white">Simpan</button>
        <button type="button" onclick="resetForm()" class="px-4 py-2 rounded border">Reset</button>
      </div>
    </form>
  </div>

  <div class="border rounded-xl overflow-x-auto">
    <table class="min-w-full text-left">
      <thead><tr class="bg-gray-50 text-sm"><th class="p-3">ID</th><th class="p-3">Nama</th><th class="p-3">Deskripsi</th><th class="p-3">Aksi</th></tr></thead>
      <tbody id="table-body" class="text-sm"></tbody>
    </table>
  </div>
</div>

<script>
const slug = @json($slug);
const routes = {
  list:   "{{ route('api-mgmt.index', ':slug') }}".replace(':slug', slug),
  store:  "{{ route('api-mgmt.store', ':slug') }}".replace(':slug', slug),
  update: id => "{{ route('api-mgmt.update', [':slug', ':id']) }}".replace(':slug', slug).replace(':id', id),
  delete: id => "{{ route('api-mgmt.destroy', [':slug', ':id']) }}".replace(':slug', slug).replace(':id', id),
};
const csrf = document.querySelector('meta[name="csrf-token"]').content;

function escapeHtml(s=''){return s.replace(/[&<>"']/g,m=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;'}[m]));}

async function loadTable(){
  const res = await fetch(routes.list); const json = await res.json();
  const body = document.getElementById('table-body'); body.innerHTML='';
  if(!json.ok){ body.innerHTML = `<tr><td colspan="4" class="p-3 text-red-600">${json.message||'Gagal memuat'}</td></tr>`; return; }
  const rows = Array.isArray(json.data)?json.data:(json.data?.data||json.data)||[];
  if(rows.length===0){ body.innerHTML = `<tr><td colspan="4" class="p-3 text-gray-500">Belum ada data.</td></tr>`; return; }
  rows.forEach(x=>{
    const id=x.id??x.ID??x.id_makanan??'';
    const nm=x.nama??x.name??x.title??'';
    const ds=x.deskripsi??x.description??x.desc??'';
    body.insertAdjacentHTML('beforeend', `
      <tr class="border-t">
        <td class="p-3 font-mono">${id}</td>
        <td class="p-3">${escapeHtml(nm)}</td>
        <td class="p-3">${escapeHtml(ds)}</td>
        <td class="p-3">
          <button class="text-blue-600 hover:underline mr-3" onclick='startEdit(${JSON.stringify({id, nm, ds})})'>Edit</button>
          <button class="text-red-600 hover:underline" onclick="doDelete('${id}')">Hapus</button>
        </td>
      </tr>`);
  });
}
function startEdit({id,nm,ds}){ editingId.value=id; nama.value=nm; deskripsi.value=ds; submitBtn.textContent='Update'; }
function resetForm(){ editingId.value=''; nama.value=''; deskripsi.value=''; submitBtn.textContent='Simpan'; }
async function submitForm(e){
  e.preventDefault();
  const id = editingId.value.trim();
  const payload = { nama: nama.value.trim(), deskripsi: deskripsi.value.trim() };
  const res = await fetch(id?routes.update(id):routes.store,{ method:id?'PUT':'POST', headers:{'Content-Type':'application/json','X-CSRF-TOKEN':csrf}, body:JSON.stringify(payload) });
  const j = await res.json(); if(!j.ok){ alert(j.message||'Gagal'); return false; } resetForm(); loadTable(); return false;
}
async function doDelete(id){
  if(!confirm('Hapus data ini?')) return;
  const res = await fetch(routes.delete(id),{ method:'DELETE', headers:{'X-CSRF-TOKEN':csrf} });
  const j = await res.json(); if(!j.ok){ alert(j.message||'Gagal'); return; } loadTable();
}
document.addEventListener('DOMContentLoaded', loadTable);
</script>
@endsection
