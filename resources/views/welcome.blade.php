<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Krusit — Pesan Jajanan by Bagoster</title>
    @vite('resources/css/app.css')
    <meta name="description" content="Krusit by Bagoster — pesan jajanan rumahan favoritmu, fresh, cepat, dan hemat.">
</head>
<body class="relative min-h-screen text-gray-900">

    <!-- Background + dekorasi -->
    <div class="absolute inset-0 -z-10">
        <div class="absolute inset-0 bg-cover bg-center"
             style="background-image: url('{{ asset('img/krusit2.png') }}');"></div>
        <!-- Overlay gradient + blur -->
        <div class="absolute inset-0 bg-gradient-to-b from-amber-200/70 via-yellow-100/80 to-white/90 backdrop-blur-[2px]"></div>

        <!-- Bokeh dekorasi -->
        <div class="pointer-events-none absolute -top-16 -right-10 h-72 w-72 rounded-full bg-amber-300/50 blur-3xl"></div>
        <div class="pointer-events-none absolute bottom-10 -left-10 h-72 w-72 rounded-full bg-yellow-200/60 blur-3xl"></div>
    </div>

    <!-- Header / Navbar -->
    <header class="sticky top-0 z-40 bg-white/60 backdrop-blur border-b border-black/5">
        <div class="mx-auto max-w-7xl px-6 py-4 flex items-center justify-between">
            <a href="{{ url('/') }}" class="flex items-center gap-3">
                <div class="w-9 h-9 grid place-items-center rounded-xl bg-amber-300/80 ring-1 ring-black/10 shadow-sm">
                    <!-- Breeze logo (jika ada) -->
                    <x-application-logo class="w-6 h-6 text-gray-900" />
                </div>
                <div class="leading-tight">
                    <span class="block text-sm tracking-wide text-gray-600">Krusit</span>
                    <strong class="block -mt-0.5 text-lg">by Bagoster</strong>
                </div>
            </a>

            <nav class="hidden md:flex items-center gap-8 text-sm font-medium">
                <a href="#menu" class="hover:text-gray-700">Menu</a>
                <a href="#cara" class="hover:text-gray-700">Cara Pesan</a>
                <a href="#testimoni" class="hover:text-gray-700">Testimoni</a>
                <a href="#kontak" class="hover:text-gray-700">Kontak</a>
            </nav>

            <div class="flex items-center gap-3">
                <a href="{{ route('login') }}"
                   class="hidden sm:inline-flex px-4 py-2 rounded-xl font-semibold ring-1 ring-black/10 hover:ring-black/20 bg-white/80 hover:bg-white transition">
                    Masuk
                </a>
                <a href="{{ route('register') }}"
                   class="inline-flex px-4 py-2 rounded-xl font-semibold shadow-sm bg-gray-900 text-amber-300 hover:bg-gray-800 transition">
                    Daftar
                </a>
            </div>
        </div>
    </header>

    <!-- Hero -->
    <section class="mx-auto max-w-7xl px-6 pt-14 pb-16 lg:pt-20 lg:pb-20">
        <div class="grid lg:grid-cols-2 gap-10 items-center">
            <div>
                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold ring-1 ring-black/10 bg-amber-100/70 text-gray-800">
                    🍢 Fresh • ⚡ Cepat • 💛 Hemat
                </span>
                <h1 class="mt-4 text-4xl md:text-5xl font-extrabold leading-tight">
                    Pesan <span class="bg-clip-text text-transparent bg-gradient-to-r from-amber-500 to-yellow-400">Jajanan Favorit</span> 
                    rumahanmu — <span class="whitespace-nowrap">langsung dari Krusit.</span>
                </h1>
                <p class="mt-4 text-lg text-gray-700">
                    Cicipi pilihan jajanan rumahan khas Bagoster: rasa nagih, harga ramah kantong, dikirim cepat ke tempatmu.
                </p>

                <!-- CTA -->
                <div class="mt-6 flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('register') }}"
                       class="px-6 py-3 rounded-2xl font-semibold bg-gray-900 text-amber-300 shadow-sm hover:bg-gray-800 transition">
                        Mulai Pesan Sekarang
                    </a>
                    <a href="#menu"
                       class="px-6 py-3 rounded-2xl font-semibold ring-1 ring-black/10 bg-white/80 hover:bg-white transition">
                       Lihat Menu
                    </a>
                </div>

                <!-- Search -->
                <form class="mt-6" action="{{ url('/menu') }}" method="GET">
                    <label for="q" class="sr-only">Cari jajanan</label>
                    <div class="flex items-stretch gap-2">
                        <input id="q" name="q" type="text" placeholder="Cari: Pangsit Goreng, Cireng, Gohyong..."
                               class="w-full px-4 py-3 rounded-xl ring-1 ring-black/10 bg-white/90 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-400 transition">
                        <button type="submit"
                                class="px-4 py-3 rounded-xl font-semibold bg-amber-300 ring-1 ring-black/10 hover:bg-amber-200 transition">
                            Cari
                        </button>
                    </div>
                </form>
            </div>

            <!-- Hero Card -->
            <div class="relative">
                <div class="relative mx-auto max-w-md rounded-3xl bg-white/90 backdrop-blur p-4 ring-1 ring-black/10 shadow-lg">
                    <img src="{{ asset('img/menu-risoles.png') }}" alt="Risoles Keju Lumer"
                         class="w-full h-60 object-cover rounded-2xl ring-1 ring-black/10">
                    <div class="mt-4 flex items-start justify-between gap-4">
                        <div>
                            <h3 class="text-xl font-bold">Pangsit Goreng</h3>
                            <p class="text-gray-600 text-sm">Kulit crispy, isian melimpah, cocok untuk semua momen.</p>
                        </div>
                        <span class="inline-flex items-center px-3 py-1 rounded-xl text-sm font-semibold bg-amber-100 ring-1 ring-black/10">Rp6.000</span>
                    </div>
                    <div class="mt-4 flex justify-end">
                        <a href="{{ route('login') }}"
                           class="px-4 py-2 rounded-xl font-semibold bg-gray-900 text-amber-300 hover:bg-gray-800 transition">
                            Tambah ke Keranjang
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Fitur singkat -->
        <div class="mt-12 grid sm:grid-cols-3 gap-4">
            <div class="rounded-2xl bg-white/80 ring-1 ring-black/10 p-5">
                <div class="text-2xl">⏱️</div>
                <h4 class="mt-2 font-semibold">Proses Cepat</h4>
                <p class="text-sm text-gray-600">Pesanan diproses segera—pas untuk meeting, arisan, atau ngemil santai.</p>
            </div>
            <div class="rounded-2xl bg-white/80 ring-1 ring-black/10 p-5">
                <div class="text-2xl">🥗</div>
                <h4 class="mt-2 font-semibold">Selalu Fresh</h4>
                <p class="text-sm text-gray-600">Dibuat harian dengan bahan pilihan agar rasa tetap konsisten.</p>
            </div>
            <div class="rounded-2xl bg-white/80 ring-1 ring-black/10 p-5">
                <div class="text-2xl">💸</div>
                <h4 class="mt-2 font-semibold">Harga Bersahabat</h4>
                <p class="text-sm text-gray-600">Porsi pas, harga pas—cocok untuk kantong mahasiswa & kantor.</p>
            </div>
        </div>
    </section>

    <!-- Menu Preview -->
    <section id="menu" class="mx-auto max-w-7xl px-6 py-10">
        <div class="flex items-end justify-between">
            <div>
                <h2 class="text-2xl md:text-3xl font-extrabold">Menu Favorit</h2>
                <p class="text-gray-600 mt-1">Intip beberapa best seller kami. Lengkapnya ada di halaman menu setelah login.</p>
            </div>
            <a href="{{ url('/register') }}" class="hidden sm:inline-flex text-sm font-semibold px-4 py-2 rounded-xl ring-1 ring-black/10 bg-white/80 hover:bg-white transition">
                Lihat Semua
            </a>
        </div>

        <div class="mt-6 grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Card 1 -->
            <article class="rounded-2xl bg-white/90 ring-1 ring-black/10 p-4 shadow-sm">
                <img src="{{ asset('img/Cireng.png') }}" alt="Cireng Bumbu Rujak"
                     class="w-full h-44 object-cover rounded-xl ring-1 ring-black/10">
                <div class="mt-3 flex items-start justify-between">
                    <div>
                        <h3 class="font-bold">Cireng Bumbu Rujak</h3>
                        <p class="text-sm text-gray-600">Gurih kenyal, bumbu pedas-manis nagih.</p>
                    </div>
                    <span class="px-3 py-1 rounded-xl text-sm font-semibold bg-amber-100 ring-1 ring-black/10">Rp15.000</span>
                </div>
                <div class="mt-3">
                    <a href="{{ route('register') }}"
                       class="inline-flex px-4 py-2 rounded-xl font-semibold bg-gray-900 text-amber-300 hover:bg-gray-800 transition">
                        Pesan
                    </a>
                </div>
            </article>

            <!-- Card 2 -->
            <article class="rounded-2xl bg-white/90 ring-1 ring-black/10 p-4 shadow-sm">
                <img src="{{ asset('img/Pangsit Goreng.png') }}" alt="Pangsit Goreng"
                     class="w-full h-44 object-cover rounded-xl ring-1 ring-black/10">
                <div class="mt-3 flex items-start justify-between">
                    <div>
                        <h3 class="font-bold">Pangsit Goreng</h3>
                        <p class="text-sm text-gray-600">Crispy di luar, padat di dalam.</p>
                    </div>
                    <span class="px-3 py-1 rounded-xl text-sm font-semibold bg-amber-100 ring-1 ring-black/10">Rp26.000</span>
                </div>
                <div class="mt-3">
                    <a href="{{ route('register') }}"
                       class="inline-flex px-4 py-2 rounded-xl font-semibold bg-gray-900 text-amber-300 hover:bg-gray-800 transition">
                        Pesan
                    </a>
                </div>
            </article>

            <!-- Card 3 -->
            <article class="rounded-2xl bg-white/90 ring-1 ring-black/10 p-4 shadow-sm">
                <img src="{{ asset('img/gohyong.png') }}" alt="Gohyong"
                     class="w-full h-44 object-cover rounded-xl ring-1 ring-black/10">
                <div class="mt-3 flex items-start justify-between">
                    <div>
                        <h3 class="font-bold">Gohyong</h3>
                        <p class="text-sm text-gray-600">Gurih, Pedes, Cocok di Lidah</p>
                    </div>
                    <span class="px-3 py-1 rounded-xl text-sm font-semibold bg-amber-100 ring-1 ring-black/10">Rp25.000</span>
                </div>
                <div class="mt-3">
                    <a href="{{ route('register') }}"
                       class="inline-flex px-4 py-2 rounded-xl font-semibold bg-gray-900 text-amber-300 hover:bg-gray-800 transition">
                        Pesan
                    </a>
                </div>
            </article>
        </div>

        <div class="mt-6 sm:hidden">
            <a href="{{ url('/register') }}" class="inline-flex text-sm font-semibold px-4 py-2 rounded-xl ring-1 ring-black/10 bg-white/80 hover:bg-white transition">
                Lihat Semua Menu
            </a>
        </div>
    </section>

    <!-- Cara Pesan -->
    <section id="cara" class="mx-auto max-w-7xl px-6 py-12">
        <h2 class="text-2xl md:text-3xl font-extrabold">Cara Pesan</h2>
        <div class="mt-6 grid md:grid-cols-3 gap-6">
            <div class="rounded-2xl bg-white/90 ring-1 ring-black/10 p-6">
                <div class="text-2xl">🛒</div>
                <h4 class="mt-2 font-semibold">1. Daftarkan diri</h4>
                <p class="text-sm text-gray-600">Dengan mendaftarkan diri mengunakan email agar dapat mengikuti update dari Krusit.</p>
            </div>
            <div class="rounded-2xl bg-white/90 ring-1 ring-black/10 p-6">
                <div class="text-2xl">🛒</div>
                <h4 class="mt-2 font-semibold">1. Pilih Menu</h4>
                <p class="text-sm text-gray-600">Telusuri menu, pilih item favorit, lalu klik “Pesan”.</p>
            </div>
            <div class="rounded-2xl bg-white/90 ring-1 ring-black/10 p-6">
                <div class="text-2xl">🧾</div>
                <h4 class="mt-2 font-semibold">2. Atur Pesanan</h4>
                <p class="text-sm text-gray-600">Tentukan jumlah & catatan (level pedas, saus, dsb.).</p>
            </div>
            <div class="rounded-2xl bg-white/90 ring-1 ring-black/10 p-6">
                <div class="text-2xl">🚚</div>
                <h4 class="mt-2 font-semibold">3. Bayar & Nikmati</h4>
                <p class="text-sm text-gray-600">Selesaikan pembayaran, pesanan segera kami proses & kirim.</p>
            </div>
        </div>
    </section>

    <!-- Testimoni -->
    <section id="testimoni" class="mx-auto max-w-7xl px-6 py-12">
        <h2 class="text-2xl md:text-3xl font-extrabold">Kata Mereka</h2>
        <div class="mt-6 grid md:grid-cols-3 gap-6">
            <figure class="rounded-2xl bg-white/90 ring-1 ring-black/10 p-6">
                <blockquote class="text-sm text-gray-700">“Cirengnya gurih banget, bumbu rujaknya bikin nagih!”</blockquote>
                <figcaption class="mt-3 text-xs text-gray-500">— Rani, Mahasiswi</figcaption>
            </figure>
            <figure class="rounded-2xl bg-white/90 ring-1 ring-black/10 p-6">
                <blockquote class="text-sm text-gray-700">“Orderan kantor 50 porsi rapi & tepat waktu. Mantap.”</blockquote>
                <figcaption class="mt-3 text-xs text-gray-500">— Bima, HRD</figcaption>
            </figure>
            <figure class="rounded-2xl bg-white/90 ring-1 ring-black/10 p-6">
                <blockquote class="text-sm text-gray-700">“Risoles kejunya lumer, anak-anak suka semua.”</blockquote>
                <figcaption class="mt-3 text-xs text-gray-500">— Mira, Ibu Rumah Tangga</figcaption>
            </figure>
        </div>
    </section>

    <!-- Footer -->
    <footer id="kontak" class="mt-6 border-t border-black/5 bg-white/70">
        <div class="mx-auto max-w-7xl px-6 py-10 grid md:grid-cols-3 gap-6">
            <div>
                <h4 class="font-bold">Krusit by Bagoster</h4>
                <p class="mt-2 text-sm text-gray-600">Jajanan rumahan fresh setiap hari. Cocok untuk event & keseharian.</p>
            </div>
            <div>
                <h4 class="font-bold">Navigasi</h4>
                <ul class="mt-2 text-sm text-gray-600 space-y-1">
                    <li><a class="hover:text-gray-800" href="#menu">Menu</a></li>
                    <li><a class="hover:text-gray-800" href="#cara">Cara Pesan</a></li>
                    <li><a class="hover:text-gray-800" href="#testimoni">Testimoni</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold">Kontak</h4>
                <ul class="mt-2 text-sm text-gray-600 space-y-1">
                    <li>Email: <a class="hover:text-gray-800" href="mailto:krusitmakassar@gmail.com">krusitmakassar@gmail.com</a></li>
                    <li>WhatsApp: <a class="hover:text-gray-800" href="https://wa.me/6281234567890">+62 812-3456-7890</a></li>
                </ul>
            </div>
        </div>
        <div class="text-center text-sm text-gray-600 pb-8">
            &copy; {{ date('Y') }} Krusit. All rights reserved.
        </div>
    </footer>

</body>
</html>
