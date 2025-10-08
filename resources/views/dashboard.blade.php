{{-- resources/views/dashboard.blade.php --}}
<x-app-layout>
    {{-- HEADER --}}
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-extrabold text-gray-900">Dashboard</h2>
                <p class="text-sm text-gray-600">
                    Selamat datang, <span class="font-semibold">{{ Auth::user()->name ?? 'Bagoster' }}</span> 👋
                </p>
            </div>
            <div class="hidden sm:flex items-center gap-2">
                <a href="{{ route('orders.index') }}"
                   class="px-4 py-2 rounded-xl font-semibold bg-gray-900 text-amber-300 hover:bg-gray-800 transition">
                    Kelola Pesanan
                </a>
                <a href="{{ route('products.create') }}"
                   class="px-4 py-2 rounded-xl font-semibold ring-1 ring-black/10 bg-white hover:bg-gray-50 transition">
                    + Produk Baru
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- HERO MINI (branding halus) --}}
            <section class="relative overflow-hidden rounded-3xl ring-1 ring-black/10 bg-gradient-to-r from-amber-200/60 via-yellow-100/70 to-white p-6">
                <div class="grid lg:grid-cols-2 gap-6 items-center">
                    <div>
                        <h3 class="text-xl font-extrabold text-gray-900">Krusit by Bagoster</h3>
                        <p class="mt-1 text-sm text-gray-700">
                            Pantau performa harian—pesanan, omzet, dan produk terlaris—semua di satu layar.
                        </p>
                        <div class="mt-4 flex flex-wrap gap-2">
                            <a href="{{ route('orders.create') }}"
                               class="px-4 py-2 rounded-xl font-semibold bg-gray-900 text-amber-300 hover:bg-gray-800 transition">
                                + Buat Pesanan
                            </a>
                            <a href="{{ route('products.index') }}"
                               class="px-4 py-2 rounded-xl font-semibold ring-1 ring-black/10 bg-white hover:bg-gray-50 transition">
                                Kelola Produk
                            </a>
                        </div>
                    </div>

                    {{-- Mini chart (SVG) --}}
                    @php
                        $points = $chartPoints ?? [3,6,5,8,7,9,11,10,12,13,12,15];
                        $maxVal = max($points);
                        $count  = max(count($points), 1);
                        $w = 420; $h = 120; $pad = 12;
                        $coords = [];
                        foreach ($points as $i => $v) {
                            $x = $pad + ($i / max($count-1,1)) * ($w - 2*$pad);
                            $y = $h - $pad - ($v / max($maxVal,1)) * ($h - 2*$pad);
                            $coords[] = $x.','.$y;
                        }
                    @endphp
                    <div class="lg:justify-self-end">
                        <div class="rounded-2xl bg-white/90 ring-1 ring-black/10 p-4 shadow-sm">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-semibold text-gray-700">Omzet 12 Hari Terakhir</p>
                                <span class="text-xs text-gray-500">Demo</span>
                            </div>
                            <svg viewBox="0 0 {{ $w }} {{ $h }}" class="mt-2 w-full" aria-hidden="true">
                                <defs>
                                    <linearGradient id="g1" x1="0" y1="0" x2="0" y2="1">
                                        <stop offset="0%" stop-color="#fbbf24" stop-opacity="0.45" />
                                        <stop offset="100%" stop-color="#ffffff" stop-opacity="0" />
                                    </linearGradient>
                                </defs>
                                @for ($gy = 0; $gy < 4; $gy++)
                                    @php $gyy = $pad + $gy * (($h - 2*$pad)/3); @endphp
                                    <line x1="{{ $pad }}" y1="{{ $gyy }}" x2="{{ $w - $pad }}" y2="{{ $gyy }}"
                                          stroke="rgba(0,0,0,0.06)" stroke-width="1"/>
                                @endfor
                                <polyline points="{{ implode(' ', $coords) }}" fill="url(#g1)" stroke="none"/>
                                <polyline points="{{ implode(' ', $coords) }}" fill="none" stroke="#0f172a"
                                          stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="pointer-events-none absolute -top-8 -right-8 h-44 w-44 rounded-full bg-amber-300/50 blur-3xl"></div>
                <div class="pointer-events-none absolute -bottom-10 -left-10 h-44 w-44 rounded-full bg-yellow-200/60 blur-3xl"></div>
            </section>

            {{-- KPI CARDS --}}
            @php
                $ordersTotal  = $stats['orders_total']   ?? 0;
                $revenueToday = $stats['revenue_today']  ?? 0;
                $avgOrder     = $stats['avg_order']      ?? 0;
                $pending      = $stats['pending']        ?? 0;
            @endphp

            <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="rounded-2xl bg-white/90 ring-1 ring-black/10 p-5 shadow-sm">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-semibold text-gray-600">Total Pesanan</p>
                        <span class="text-xl">🧾</span>
                    </div>
                    <p class="mt-2 text-3xl font-extrabold text-gray-900">{{ number_format($ordersTotal) }}</p>
                    <p class="mt-1 text-xs text-gray-500">Akumulasi semua waktu</p>
                </div>

                <div class="rounded-2xl bg-white/90 ring-1 ring-black/10 p-5 shadow-sm">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-semibold text-gray-600">Omzet Hari Ini</p>
                        <span class="text-xl">💰</span>
                    </div>
                    <p class="mt-2 text-3xl font-extrabold text-gray-900">Rp{{ number_format($revenueToday, 0, ',', '.') }}</p>
                    <p class="mt-1 text-xs text-gray-500">Update realtime</p>
                </div>

                <div class="rounded-2xl bg-white/90 ring-1 ring-black/10 p-5 shadow-sm">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-semibold text-gray-600">Rata-rata Order</p>
                        <span class="text-xl">📦</span>
                    </div>
                    <p class="mt-2 text-3xl font-extrabold text-gray-900">Rp{{ number_format($avgOrder, 0, ',', '.') }}</p>
                    <p class="mt-1 text-xs text-gray-500">Ticket size</p>
                </div>

                <div class="rounded-2xl bg-white/90 ring-1 ring-black/10 p-5 shadow-sm">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-semibold text-gray-600">Menunggu Proses</p>
                        <span class="text-xl">⏳</span>
                    </div>
                    <p class="mt-2 text-3xl font-extrabold text-gray-900">{{ number_format($pending) }}</p>
                    <p class="mt-1 text-xs text-gray-500">Butuh tindakan</p>
                </div>
            </section>

            {{-- AKSI CEPAT + PROGRESS + TOP PRODUCTS --}}
            <section class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 rounded-2xl bg-white/90 ring-1 ring-black/10 p-5 shadow-sm">
                    <div class="flex items-center justify-between">
                        <h4 class="text-base font-extrabold text-gray-900">Aksi Cepat</h4>
                        <a href="{{ route('reports.index') }}" class="text-sm font-semibold text-gray-700 hover:text-gray-900">Laporan</a>
                    </div>
                    <div class="mt-4 grid sm:grid-cols-3 gap-3">
                        <a href="{{ route('orders.create') }}"
                           class="rounded-xl px-4 py-3 font-semibold text-center ring-1 ring-black/10 bg-white hover:bg-gray-50 transition">+ Buat Pesanan</a>
                        <a href="{{ route('products.index') }}"
                           class="rounded-xl px-4 py-3 font-semibold text-center ring-1 ring-black/10 bg-white hover:bg-gray-50 transition">Kelola Produk</a>
                        <a href="{{ route('orders.index') }}"
                           class="rounded-xl px-4 py-3 font-semibold text-center bg-gray-900 text-amber-300 hover:bg-gray-800 transition">Lihat Antrian</a>
                    </div>

                    @php
                        $fulfilled = $stats['fulfilled_today'] ?? 0;
                        $target    = max($stats['target_today'] ?? 20, 1);
                        $pct       = min(100, round(($fulfilled / $target) * 100));
                    @endphp
                    <div class="mt-6">
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-semibold text-gray-700">Progress Pemenuhan Hari Ini</p>
                            <span class="text-xs text-gray-600">{{ $fulfilled }} / {{ $target }} pesanan</span>
                        </div>
                        <div class="mt-2 h-3 w-full rounded-full bg-gray-100 ring-1 ring-inset ring-black/5 overflow-hidden">
                            <div class="h-3 rounded-full bg-gradient-to-r from-amber-400 to-yellow-300" style="width: {{ $pct }}%"></div>
                        </div>
                        <p class="mt-1 text-xs text-gray-500">{{ $pct }}% tercapai</p>
                    </div>
                </div>

                @php
                    $topProducts = $topProducts ?? [
                        ['name' => 'Pangsit Goreng',       'sold' => 128],
                        ['name' => 'Cireng Bumbu Rujak',   'sold' => 114],
                        ['name' => 'Gohyong',              'sold' => 96],
                    ];
                @endphp
                <div class="rounded-2xl bg-white/90 ring-1 ring-black/10 p-5 shadow-sm">
                    <h4 class="text-base font-extrabold text-gray-900">Top Products</h4>
                    <ul class="mt-3 space-y-3">
                        @forelse ($topProducts as $p)
                            <li class="flex items-center justify-between">
                                <div class="min-w-0">
                                    <p class="truncate font-semibold text-gray-800">{{ $p['name'] ?? '-' }}</p>
                                    <p class="text-xs text-gray-500">Terjual</p>
                                </div>
                                <span class="px-3 py-1 rounded-xl text-sm font-semibold bg-amber-100 ring-1 ring-black/10">
                                    {{ number_format($p['sold'] ?? 0) }}
                                </span>
                            </li>
                        @empty
                            <li class="text-sm text-gray-500">Belum ada data.</li>
                        @endforelse
                    </ul>
                </div>
            </section>

            {{-- RECENT ORDERS + LOW STOCK --}}
            @php
                $recentOrders = $recentOrders ?? [
                    ['code' => 'ORD-00123', 'customer' => 'Rani', 'total' => 36000, 'status' => 'Selesai', 'time' => '10:12'],
                    ['code' => 'ORD-00124', 'customer' => 'Bima', 'total' => 54000, 'status' => 'Proses',  'time' => '10:35'],
                    ['code' => 'ORD-00125', 'customer' => 'Mira', 'total' => 25000, 'status' => 'Baru',    'time' => '10:48'],
                ];
                $statusColor = [
                    'Baru'    => 'bg-yellow-100 text-yellow-800 ring-yellow-200',
                    'Proses'  => 'bg-blue-100 text-blue-800 ring-blue-200',
                    'Selesai' => 'bg-green-100 text-green-800 ring-green-200',
                    'Batal'   => 'bg-red-100 text-red-800 ring-red-200',
                ];
                $lowStocks = $lowStocks ?? [
                    ['name' => 'Kulit Pangsit', 'qty' => 12, 'unit' => 'pak'],
                    ['name' => 'Minyak Goreng', 'qty' => 3,  'unit' => 'liter'],
                ];
            @endphp

            <section class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 rounded-2xl bg-white/90 ring-1 ring-black/10 p-5 shadow-sm">
                    <div class="flex items-center justify-between">
                        <h4 class="text-base font-extrabold text-gray-900">Recent Orders</h4>
                        <a href="{{ route('orders.index') }}" class="text-sm font-semibold text-gray-700 hover:text-gray-900">Lihat semua</a>
                    </div>

                    <div class="mt-4 overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead>
                                <tr class="text-left text-xs uppercase text-gray-500 tracking-wider">
                                    <th class="py-2 pr-4">Kode</th>
                                    <th class="py-2 pr-4">Customer</th>
                                    <th class="py-2 pr-4">Total</th>
                                    <th class="py-2 pr-4">Waktu</th>
                                    <th class="py-2 pr-4">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse ($recentOrders as $o)
                                    <tr class="hover:bg-gray-50/80">
                                        <td class="py-2 pr-4 font-semibold text-gray-800">{{ $o['code'] ?? '-' }}</td>
                                        <td class="py-2 pr-4">{{ $o['customer'] ?? '-' }}</td>
                                        <td class="py-2 pr-4">Rp{{ number_format($o['total'] ?? 0, 0, ',', '.') }}</td>
                                        <td class="py-2 pr-4">{{ $o['time'] ?? '-' }}</td>
                                        @php $cls = $statusColor[$o['status'] ?? 'Baru'] ?? 'bg-gray-100 text-gray-800 ring-gray-200'; @endphp
                                        <td class="py-2 pr-4">
                                            <span class="px-3 py-1 rounded-xl text-xs font-semibold ring-1 {{ $cls }}">
                                                {{ $o['status'] ?? '-' }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5" class="py-4 text-center text-gray-500">Belum ada pesanan.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="rounded-2xl bg-white/90 ring-1 ring-black/10 p-5 shadow-sm">
                    <h4 class="text-base font-extrabold text-gray-900">Stok Hampir Habis</h4>
                    <ul class="mt-3 space-y-3">
                        @forelse ($lowStocks as $s)
                            <li class="flex items-center justify-between">
                                <div class="min-w-0">
                                    <p class="truncate font-semibold text-gray-800">{{ $s['name'] ?? '-' }}</p>
                                    <p class="text-xs text-gray-500">Sisa stok</p>
                                </div>
                                <span class="px-3 py-1 rounded-xl text-sm font-semibold bg-red-100 text-red-800 ring-1 ring-red-200">
                                    {{ number_format($s['qty'] ?? 0) }} {{ $s['unit'] ?? '' }}
                                </span>
                            </li>
                        @empty
                            <li class="text-sm text-gray-500">Semua stok aman.</li>
                        @endforelse
                    </ul>
                    <div class="mt-4">
                        <a href="{{ route('products.index') }}"
                           class="inline-flex px-4 py-2 rounded-xl font-semibold ring-1 ring-black/10 bg-white hover:bg-gray-50 transition">
                            Kelola Stok
                        </a>
                    </div>
                </div>
            </section>

        </div>
    </div>
</x-app-layout>
