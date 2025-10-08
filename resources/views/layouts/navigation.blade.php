<nav x-data="{ open: false }" class="z-30 bg-orange-400">
    <!-- Primary Navigation Menu -->
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="flex items-center shrink-0">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block w-auto text-gray-800 fill-current h-9" />
                    </a>
                </div>

                <!-- Navigation Links (desktop) -->
                <div class="hidden sm:flex items-center ms-6 gap-4 lg:gap-6">
                    <!-- Dropdown: Pesan Disini (ganti dari Menu Varian) -->
                    <x-dropdown align="center" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center rounded-full px-4 py-2 text-sm font-semibold text-black
                                       transition hover:bg-orange-500/90 focus:outline-none focus-visible:ring-2 focus-visible:ring-black/20">
                                {{ __('Pesan Disini') }}
                                <svg class="ms-2 h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.085l3.71-3.855a.75.75 0 111.08 1.04l-4.24 4.41a.75.75 0 01-1.08 0L5.25 8.27a.75.75 0 01-.02-1.06z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </x-slot>

                        <!-- Dropdown Menu -->
                        <x-slot name="content">
                            <div class="bg-white rounded-md shadow-lg">
                                <x-dropdown-link :href="route('makanan')" class="block px-4 py-2 text-black hover:bg-gray-100">
                                    {{ __('Makanan') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('minuman')" class="block px-4 py-2 text-black hover:bg-gray-100">
                                    {{ __('Minuman') }}
                                </x-dropdown-link>
                            </div>
                        </x-slot>
                    </x-dropdown>

                    <!-- Kontak -->
                    <x-nav-link :href="route('kontak')" :active="request()->routeIs('kontak')">
                        {{ __('Kontak') }}
                    </x-nav-link>

                    <!-- Lihat Pesanan -->
                    <x-nav-link :href="route('pesanan.index')" :active="request()->routeIs('pesanan.index')">
                        {{ __('Lihat Pesanan') }}
                    </x-nav-link>

                    @if (Auth::check() && Auth::user()->role === 'admin')
                        <x-nav-link :href="route('barang.create')" :active="request()->routeIs('barang.create')">
                            {{ __('Tambah Menu') }}
                        </x-nav-link>
                        <x-nav-link :href="route('barang.index')" :active="request()->routeIs('barang.index')">
                            {{ __('Edit Menu') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="block sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48" class="z-10">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center rounded-md px-3 py-2 text-sm font-medium text-gray-900
                                   transition bg-orange-400 hover:bg-orange-500 focus:outline-none focus-visible:ring-2 focus-visible:ring-black/20">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="flex items-center -me-2 sm:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 text-gray-700 rounded-md
                               transition hover:text-gray-900 hover:bg-orange-300/60 focus:outline-none focus:bg-orange-300/60">
                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            <!-- Pesan Disini (mobile) -->
            <x-responsive-nav-link :href="route('makanan')">
                {{ __('Pesan Disini') }}
            </x-responsive-nav-link>
            <div class="ms-4">
                <x-responsive-nav-link :href="route('makanan')">
                    {{ __('• Makanan') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('minuman')">
                    {{ __('• Minuman') }}
                </x-responsive-nav-link>
            </div>

            <x-responsive-nav-link :href="route('kontak')" :active="request()->routeIs('kontak')">
                {{ __('Kontak') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('pesanan.index')" :active="request()->routeIs('pesanan.index')">
                {{ __('Lihat Pesanan') }}
            </x-responsive-nav-link>

            @if (Auth::check() && Auth::user()->role === 'admin')
                <x-responsive-nav-link :href="route('barang.create')" :active="request()->routeIs('barang.create')">
                    {{ __('Tambah Menu') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('barang.index')" :active="request()->routeIs('barang.index')">
                    {{ __('Edit Menu') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-orange-300/50">
            <div class="px-4">
                <div class="text-base font-medium text-gray-900">{{ Auth::user()->name }}</div>
                <div class="text-sm font-medium text-gray-700">{{ Auth::user()->email }}</div>
                @if (Auth::check())
                    <p class="mt-1 text-sm text-gray-800">Role: {{ Auth::user()->role }}</p>
                @endif
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
