<nav x-data="{ open: false }" class="bg-[#800000] border-b border-gray-100">
    <!-- Menu Navigasi Utama -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Kiri: UNIVERSITAS MAJALENGKA -->
            <div class="flex items-center text-white text-xl font-semibold">
                UNIVERSITAS MAJALENGKA
            </div>
            <head>
                <!-- Link untuk Font Awesome -->
                <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
            </head>

            <!-- Tengah: Tautan Navigasi -->
            <div class="flex justify-center flex-1 space-x-8">
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white">
                    {{ __('Dashboard') }}
                </x-nav-link>
                <x-nav-link :href="route('/prodi')" :active="request()->routeIs('/prodi')" class="text-white">
                    {{ __('Program Studi') }}
                </x-nav-link>
            </div>

            <!-- Kanan: Ikon Media Sosial -->
            <div class="flex items-center space-x-4 text-white">
                <!-- Facebook -->
                <a href="https://facebook.com" target="_blank" class="text-white hover:text-blue-600 transition duration-300">
                    <i class="fab fa-facebook-f text-2xl"></i>
                </a>
                <!-- Instagram -->
                <a href="https://instagram.com" target="_blank" class="text-white hover:text-pink-600 transition duration-300">
                    <i class="fab fa-instagram text-2xl"></i>
                </a>
                <!-- TikTok -->
                <a href="https://tiktok.com" target="_blank" class="text-white hover:text-black transition duration-300">
                    <i class="fab fa-tiktok text-2xl"></i>
                </a>
                <!-- X (Twitter) -->
                <a href="https://x.com" target="_blank" class="text-white hover:text-blue-400 transition duration-300">
                    <i class="fab fa-x text-2xl"></i>
                </a>
                <!-- YouTube -->
                <a href="https://youtube.com" target="_blank" class="text-white hover:text-red-600 transition duration-300">
                    <i class="fab fa-youtube text-2xl"></i>
                </a>
            </div>

            <!-- Dropdown Pengaturan -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-[#800000] hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Otentikasi -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger untuk menu mobile -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Menu Navigasi Responsif -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('/prodi')" :active="request()->routeIs('/prodi')" class="text-white">
                {{ __('Program Studi') }}
            </x-responsive-nav-link>
        </div>

        <!-- Opsi Pengaturan Responsif -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-white">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="text-white">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Otentikasi -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();" class="text-white">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
