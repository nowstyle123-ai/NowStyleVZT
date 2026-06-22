<nav class="bg-black border-b border-zinc-800">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <span class="text-red-600 font-black text-lg tracking-wider cursor-default select-none">
                        NowStyleVZT
                    </span>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-zinc-300 hover:text-white transition">
                        {{ __('Inicio') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <div class="relative" id="user-menu-container">
                    <button id="user-menu-button" type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-zinc-400 bg-black hover:text-zinc-200 focus:outline-none transition ease-in-out duration-150">
                        <div>{{ Auth::user()?->name ?? 'Invitado' }}</div>

                        <div class="ms-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>

                    <div id="user-menu-content" class="hidden absolute z-50 mt-2 w-48 rounded-md shadow-lg end-0" style="background-color: #09090b; border: 1px solid #27272a;">
                        <div style="border-radius: 0.375rem; padding: 0.25rem 0; background-color: #09090b;">
                            <a href="{{ route('profile.edit') }}" style="display: block; width: 100%; padding: 0.5rem 1rem; text-align: start; font-size: 0.875rem; line-height: 1.25rem; color: #a1a1aa; text-decoration: none; background-color: #09090b;" class="hover:text-white">
                                {{ __('Perfil') }}
                            </a>

                            <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                                @csrf
                                <button type="submit" style="display: block; width: 100%; padding: 0.5rem 1rem; text-align: start; font-size: 0.875rem; line-height: 1.25rem; color: #a1a1aa; background-color: #09090b; border: none; cursor: pointer;" class="hover:text-white">
                                    {{ __('Cerrar Sesión') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button id="mobile-menu-button" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-zinc-500 hover:text-zinc-400 hover:bg-zinc-900 focus:outline-none focus:bg-zinc-900 focus:text-zinc-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path id="mobile-menu-icon-open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path id="mobile-menu-icon-close" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div id="mobile-menu" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Inicio') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-zinc-800">
            <div class="px-4">
                <div class="font-medium text-base text-zinc-200">{{ Auth::user()?->name ?? 'Invitado' }}</div>
                <div class="font-medium text-sm text-zinc-500">{{ Auth::user()?->email ?? 'invitado@nowstyle.com' }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Perfil') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-zinc-400 hover:text-white hover:bg-zinc-900 hover:border-zinc-700 focus:outline-none transition duration-150 ease-in-out">
                        {{ __('Cerrar Sesión') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Dropdown del menú de usuario (escritorio)
        const userMenuButton = document.getElementById('user-menu-button');
        const userMenuContent = document.getElementById('user-menu-content');
        const userMenuContainer = document.getElementById('user-menu-container');

        if (userMenuButton && userMenuContent) {
            userMenuButton.addEventListener('click', function (e) {
                e.stopPropagation();
                userMenuContent.classList.toggle('hidden');
            });

            // Cerrar al hacer clic fuera
            document.addEventListener('click', function (e) {
                if (userMenuContainer && !userMenuContainer.contains(e.target)) {
                    userMenuContent.classList.add('hidden');
                }
            });
        }

        // Menú Responsivo (móvil)
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const iconOpen = document.getElementById('mobile-menu-icon-open');
        const iconClose = document.getElementById('mobile-menu-icon-close');

        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', function () {
                mobileMenu.classList.toggle('hidden');
                iconOpen.classList.toggle('hidden');
                iconClose.classList.toggle('hidden');
            });
        }
    });
</script>