<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Krusit — Berbagi Ide & Inovasi</title>
    @vite('resources/css/app.css')

    <style>
      /* Noise tipis + animasi halus */
      .noise { 
        background-image: url('{{ asset('img/noise.png') }}');
        mix-blend-mode: overlay; opacity:.08; pointer-events:none;
      }
      @keyframes float {
        0%,100% { transform: translateY(0) }
        50%     { transform: translateY(-6px) }
      }
      @keyframes shine {
        0% { transform: translateX(-150%) }
        100% { transform: translateX(150%) }
      }
      .btn-shine::after{
        content:""; position:absolute; inset:-2px; 
        background: linear-gradient(120deg, transparent 30%, rgba(255,255,255,.35), transparent 70%);
        transform: translateX(-150%); filter: blur(0.5px);
      }
      .btn-shine:hover::after{ animation: shine .9s ease }
    </style>
</head>
<body class="min-h-screen bg-gray-950 text-white relative overflow-hidden">

    <!-- Layer: gradient + spotlight -->
    <div class="absolute inset-0 -z-30">
        <div class="absolute inset-0 bg-gradient-to-b from-gray-950 via-gray-900 to-gray-950"></div>
        <div class="absolute -top-40 -left-40 h-96 w-96 rounded-full bg-yellow-400/10 blur-3xl"></div>
        <div class="absolute -bottom-48 -right-40 h-[28rem] w-[28rem] rounded-full bg-amber-300/10 blur-3xl"></div>
        <div class="noise absolute inset-0"></div>
    </div>

    <!-- Layer: background image (opsional) -->
    <div class="absolute inset-0 -z-20 opacity-[.08] bg-cover bg-center"
         style="background-image:url('{{ asset('img/krusit2.png') }}')"></div>

    <!-- Navbar sederhana -->
    <header class="relative z-10">
      <nav class="mx-auto max-w-7xl px-6 py-5 flex items-center justify-between">
        <a href="/" class="flex items-center gap-3 group">
            <x-application-logo class="w-9 h-9 text-yellow-300" />
            <span class="text-xl font-bold tracking-tight group-hover:text-yellow-300 transition">Krusit</span>
        </a>
        <div class="flex items-center gap-3">
            <a href="{{ route('login') }}" class="px-4 py-2 text-sm rounded-xl border border-white/10 hover:border-white/30 hover:bg-white/5 transition">Masuk</a>
            <a href="{{ route('register') }}" class="relative px-4 py-2 text-sm rounded-xl bg-yellow-400 text-gray-900 font-semibold hover:bg-yellow-300 transition btn-shine overflow-hidden">Daftar</a>
        </div>
      </nav>
    </header>

    <!-- Hero -->
    <main class="relative z-10">
      <section class="mx-auto max-w-7xl px-6 pt-10 pb-16 md:pt-16 md:pb-24">
        <div class="grid lg:grid-cols-2 gap-10 items-center">
          <!-- Kiri: copy -->
          <div class="space-y-6">
            <div class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs text-white/80">
              <span class="h-2 w-2 rounded-full bg-green-400 animate-pulse"></span>
              Baru! Ruang kolaborasi ide tanpa ribet
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight">
              Tempat Ide Tumbuh Menjadi
              <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 to-amber-500">Inovasi</span>
            </h1>
            <p class="text-white/80 text-lg leading-relaxed">
              Bangun prototipe, diskusi, dan validasi ide dalam satu tempat.
              Krusit membantu tim kreatif bergerak cepat dengan UI simpel dan performa kencang.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 pt-2">
              <a href="{{ route('register') }}"
                 class="relative group inline-flex items-center justify-center rounded-2xl px-6 py-3 font-semibold text-gray-900 bg-yellow-300 hover:bg-yellow-200 transition btn-shine overflow-hidden">
                 Mulai Gratis
              </a>
              <a href="{{ route('login') }}"
                 class="inline-flex items-center justify-center rounded-2xl px-6 py-3 font-semibold border border-white/15 hover:border-white/30 hover:bg-white/5 transition">
                 Masuk Akun
              </a>
            </div>

            <!-- Trust badges -->
            <div class="flex flex-wrap items-center gap-3 pt-3 text-xs text-white/60">
              <span class="px-3 py-1 rounded-full bg-white/5 border border-white/10">Aman & Cepat</span>
              <span class="px-3 py-1 rounded-full bg-white/5 border border-white/10">Realtime Collaboration</span>
              <span class="px-3 py-1 rounded-full bg-white/5 border border-white/10">UI Minimalis</span>
            </div>
          </div>

          <!-- Kanan: kartu mockup -->
          <div class="relative">
            <!-- dekorasi -->
            <div class="absolute -top-6 -left-6 h-24 w-24 rounded-2xl bg-yellow-400/20 blur-2xl"></div>
            <div class="absolute -bottom-8 -right-8 h-28 w-28 rounded-2xl bg-amber-300/20 blur-2xl"></div>

            <div class="relative rounded-3xl border border-white/10 bg-white/5 backdrop-blur-xl shadow-2xl p-5 md:p-6 animate-[float_6s_ease-in-out_infinite]">
              <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                  <div class="h-9 w-9 rounded-xl bg-yellow-400/20 border border-white/15 flex items-center justify-center">
                    <x-application-logo class="w-5 h-5 text-yellow-300"/>
                  </div>
                  <div>
                    <p class="text-sm text-white/60">Workspace</p>
                    <p class="font-semibold">Krusit Studio</p>
                  </div>
                </div>
                <span class="text-xs px-2 py-1 rounded-lg bg-emerald-400/15 text-emerald-300 border border-emerald-300/20">Online</span>
              </div>

              <div class="mt-5 grid grid-cols-2 gap-4">
                <div class="rounded-2xl bg-white/5 border border-white/10 p-4">
                  <p class="text-xs text-white/60">Ide Aktif</p>
                  <p class="text-3xl font-extrabold">37</p>
                </div>
                <div class="rounded-2xl bg-white/5 border border-white/10 p-4">
                  <p class="text-xs text-white/60">Kolaborator</p>
                  <p class="text-3xl font-extrabold">124</p>
                </div>
                <div class="col-span-2 rounded-2xl bg-gradient-to-r from-yellow-300/20 to-amber-400/20 border border-white/10 p-4">
                  <p class="text-sm font-semibold">Sprint Minggu Ini</p>
                  <div class="mt-2 h-2 w-full rounded-full bg-white/10">
                    <div class="h-2 rounded-full bg-yellow-300" style="width:68%"></div>
                  </div>
                  <p class="mt-2 text-xs text-white/70">Progres 68% • 4 hari tersisa</p>
                </div>
              </div>

              <div class="mt-5 flex items-center gap-3">
                <img src="{{ asset('img/avatar1.png') }}" class="h-8 w-8 rounded-full border border-white/20" alt="A"/>
                <img src="{{ asset('img/avatar2.png') }}" class="h-8 w-8 rounded-full border border-white/20 -ml-2" alt="B"/>
                <img src="{{ asset('img/avatar3.png') }}" class="h-8 w-8 rounded-full border border-white/20 -ml-2" alt="C"/>
                <span class="text-xs text-white/60 ml-1">+20 lainnya berkolaborasi</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Section fitur ringkas -->
        <div class="mt-16 grid md:grid-cols-3 gap-6">
          <div class="rounded-2xl border border-white/10 bg-white/5 p-6">
            <div class="h-10 w-10 rounded-xl bg-yellow-400/20 border border-white/10 flex items-center justify-center mb-4">
              <svg viewBox="0 0 24 24" class="h-5 w-5"><path fill="currentColor" d="M12 2a10 10 0 1 0 .001 20.001A10 10 0 0 0 12 2Zm1 14h-2v-2h2v2Zm0-4h-2V6h2v6Z"/></svg>
            </div>
            <h3 class="font-semibold text-lg mb-2">Ide ke Aksi</h3>
            <p class="text-white/70">Ubah catatan jadi tugas, timeline, dan prototipe—semua serba cepat.</p>
          </div>
          <div class="rounded-2xl border border-white/10 bg-white/5 p-6">
            <div class="h-10 w-10 rounded-xl bg-yellow-400/20 border border-white/10 flex items-center justify-center mb-4">
              <svg viewBox="0 0 24 24" class="h-5 w-5"><path fill="currentColor" d="M12 3l9 6-9 6-9-6 9-6Zm0 8.197l9 6L12 23l-9-5.803 9-6Z"/></svg>
            </div>
            <h3 class="font-semibold text-lg mb-2">Kolaborasi Nyaman</h3>
            <p class="text-white/70">Komentar, mention, dan status realtime—tanpa tab berantakan.</p>
          </div>
          <div class="rounded-2xl border border-white/10 bg-white/5 p-6">
            <div class="h-10 w-10 rounded-xl bg-yellow-400/20 border border-white/10 flex items-center justify-center mb-4">
              <svg viewBox="0 0 24 24" class="h-5 w-5"><path fill="currentColor" d="M3 12h18v2H3v-2Zm0-6h18v2H3V6Zm0 12h18v2H3v-2Z"/></svg>
            </div>
            <h3 class="font-semibold text-lg mb-2">UI Ringkas & Cepat</h3>
            <p class="text-white/70">Desain minimalis, fokus ke konten. Performa mulus di semua device.</p>
          </div>
        </div>
      </section>
    </main>

    <!-- Footer -->
    <footer class="relative z-10 border-t border-white/10">
      <div class="mx-auto max-w-7xl px-6 py-8 flex flex-col md:flex-row items-center justify-between gap-3 text-white/70">
        <p>&copy; {{ date('Y') }} Krusit. Semua hak cipta.</p>
        <div class="flex items-center gap-5 text-sm">
          <a href="#" class="hover:text-white transition">Ketentuan</a>
          <a href="#" class="hover:text-white transition">Privasi</a>
          <a href="#" class="hover:text-white transition">Kontak</a>
        </div>
      </div>
    </footer>
</body>
</html>
