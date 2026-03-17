<nav x-data="{ open: false }" class="sticky-top" style="background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%); box-shadow: 0 2px 12px rgba(0,0,0,0.15);">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center me-4">
                    <a href="{{ route('dashboard') }}" class="text-white transition-transform hover:scale-105">
                        <i class="fas fa-motorcycle" style="font-size: 2rem;"></i>
                    </a>
                </div>

                <!-- Logo Text -->
                <div class="hidden sm:flex items-center">
                    <a href="{{ route('dashboard') }}" class="text-white font-bold text-lg hover:text-blue-100 transition">
                        Parqueadero
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <a href="{{ route('dashboard') }}" class="text-white px-3 py-2 rounded-md text-sm font-medium transition hover:bg-blue-700 {{ request()->routeIs('dashboard') ? 'bg-blue-700' : '' }}">
                        <i class="fas fa-chart-line me-2"></i>Dashboard
                    </a>
                    @auth
                        @if(auth()->user()->email == 'admin@parqueadero.com')
                        <a href="{{ route('parqueos.index') }}" class="text-white px-3 py-2 rounded-md text-sm font-medium transition hover:bg-blue-700 {{ request()->routeIs('parqueos.*') ? 'bg-blue-700' : '' }}">
                            <i class="fas fa-sign-in-alt me-2"></i>Parqueos
                        </a>
                        <a href="{{ route('motos.index') }}" class="text-white px-3 py-2 rounded-md text-sm font-medium transition hover:bg-blue-700 {{ request()->routeIs('motos.*') ? 'bg-blue-700' : '' }}">
                            <i class="fas fa-motorcycle me-2"></i>Motos
                        </a>
                        <a href="{{ route('planes.index') }}" class="text-white px-3 py-2 rounded-md text-sm font-medium transition hover:bg-blue-700 {{ request()->routeIs('planes.*') ? 'bg-blue-700' : '' }}">
                            <i class="fas fa-tag me-2"></i>Planes
                        </a>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <div class="text-white me-4">
                    <div class="font-semibold text-sm">{{ Auth::user()->name }}</div>
                    <div class="text-xs text-blue-100">{{ Auth::user()->email }}</div>
                </div>
                
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-white text-white bg-blue-700 hover:bg-blue-800 rounded-md font-medium transition">
                            <i class="fas fa-user-circle me-2"></i>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="text-gray-900 hover:bg-blue-50 px-4 py-2">
                            <i class="fas fa-user me-2"></i>{{ __('Mi Perfil') }}
                        </x-dropdown-link>

                        <hr class="my-2">

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); showLogoutConfirm(this.closest('form'));" class="text-red-600 hover:bg-red-50 px-4 py-2">
                                <i class="fas fa-sign-out-alt me-2"></i>{{ __('Cerrar Sesión') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:bg-blue-700 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-blue-700">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('dashboard') }}" class="text-white block px-3 py-2 rounded-md text-base font-medium hover:bg-blue-800 transition {{ request()->routeIs('dashboard') ? 'bg-blue-800' : '' }}">
                <i class="fas fa-chart-line me-2"></i>Dashboard
            </a>
            @auth
                @if(auth()->user()->email == 'admin@parqueadero.com')
                <a href="{{ route('parqueos.index') }}" class="text-white block px-3 py-2 rounded-md text-base font-medium hover:bg-blue-800 transition {{ request()->routeIs('parqueos.*') ? 'bg-blue-800' : '' }}">
                    <i class="fas fa-sign-in-alt me-2"></i>Parqueos
                </a>
                <a href="{{ route('motos.index') }}" class="text-white block px-3 py-2 rounded-md text-base font-medium hover:bg-blue-800 transition {{ request()->routeIs('motos.*') ? 'bg-blue-800' : '' }}">
                    <i class="fas fa-motorcycle me-2"></i>Motos
                </a>
                <a href="{{ route('planes.index') }}" class="text-white block px-3 py-2 rounded-md text-base font-medium hover:bg-blue-800 transition {{ request()->routeIs('planes.*') ? 'bg-blue-800' : '' }}">
                    <i class="fas fa-tag me-2"></i>Planes
                </a>
                @endif
            @endauth
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-blue-600">
            <div class="px-4">
                <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-blue-100">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <a href="{{ route('profile.edit') }}" class="text-white block px-3 py-2 rounded-md text-base font-medium hover:bg-blue-800 transition">
                    <i class="fas fa-user me-2"></i>{{ __('Mi Perfil') }}
                </a>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); showLogoutConfirm(this.closest('form'));" class="text-white block px-3 py-2 rounded-md text-base font-medium hover:bg-red-600 transition">
                        <i class="fas fa-sign-out-alt me-2"></i>{{ __('Cerrar Sesión') }}
                    </a>
                </form>
            </div>
        </div>
    </div>
</nav>

<script>
function showLogoutConfirm(form) {
    Swal.fire({
        title: '<i class="fas fa-sign-out-alt" style="color: #f59e0b;"></i> Cerrar Sesión',
        html: '<p style="font-size: 1rem; color: #374151;">¿Estás seguro de que deseas cerrar tu sesión?</p>',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, cerrar sesión',
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6b7280',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
}
</script>
