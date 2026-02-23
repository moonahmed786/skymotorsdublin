<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sky Motors Dublin') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Figtree:wght@400;500;600&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased h-full bg-slate-50 dark:bg-gray-900">
    <div class="min-h-full flex flex-col">
        <!-- Navigation -->
        <nav x-data="{ open: false }"
            class="bg-white/80 dark:bg-gray-800/90 backdrop-blur-md sticky top-0 z-50 border-b border-gray-100 dark:border-gray-700">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="shrink-0 flex items-center">
                            <a href="{{ route('dashboard') }}"
                                class="font-display font-bold text-2xl text-primary-700 dark:text-primary-400 tracking-tighter">
                                Sky<span class="text-secondary-500">Motors</span>
                            </a>
                        </div>

                        <!-- Navigation Links -->
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            @auth
                                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                                    wire:navigate>
                                    {{ __('Dashboard') }}
                                </x-nav-link>
                            @endauth
                        </div>
                    </div>

                    <!-- Settings Dropdown -->
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        @auth
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                        <div>{{ Auth::user()->name }}</div>

                                        <div class="ml-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
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

                                        <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                                        this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        @else
                            <div class="space-x-4">
                                <a href="{{ route('login') }}"
                                    class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 transition">Log
                                    in</a>
                                <a href="{{ route('register') }}"
                                    class="hidden items-center px-4 py-2 bg-primary-600 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-500 focus:bg-primary-500 active:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition ease-in-out duration-150">Register</a>
                            </div>
                        @endauth
                    </div>

                    <!-- Hamburger -->
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button @click="open = ! open"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
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
            <div :class="{'block': open, 'hidden': ! open}"
                class="hidden sm:hidden bg-white dark:bg-gray-800 border-t border-gray-100 dark:border-gray-700">
                <div class="pt-2 pb-3 space-y-1">
                    @auth
                        <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-responsive-nav-link>
                    @endauth
                </div>

                <!-- Responsive Settings Options -->
                <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                    @auth
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}
                            </div>
                            <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <x-responsive-nav-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-responsive-nav-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-responsive-nav-link>
                            </form>
                        </div>
                    @else
                        <div class="mt-3 space-y-1 px-4">
                            <x-responsive-nav-link :href="route('login')">
                                {{ __('Log in') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('register')" class="hidden">
                                {{ __('Register') }}
                            </x-responsive-nav-link>
                        </div>
                    @endauth
                </div>
            </div>
        </nav>

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow-sm">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main class="flex-grow">
            {{ $slot }}
        </main>

        <footer class="bg-white dark:bg-gray-800 border-t border-gray-100 dark:border-gray-700 py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div class="col-span-1 md:col-span-2">
                        <span
                            class="font-display font-bold text-2xl text-primary-700 dark:text-primary-400 tracking-tighter">
                            Sky<span class="text-secondary-500">Motors</span>
                        </span>
                        <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm max-w-xs">
                            Premium automotive excellence in Dublin. Finding your dream car has never been closer to
                            reality.
                        </p>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-900 dark:text-white uppercase tracking-wider">
                            Services</h3>
                        <ul class="mt-4 space-y-4">
                            <li><a href="#" class="text-base text-gray-500 hover:text-primary-600 transition">Buy a
                                    Car</a></li>
                            <li><a href="#" class="text-base text-gray-500 hover:text-primary-600 transition">Sell Your
                                    Car</a></li>
                            <li><a href="#"
                                    class="text-base text-gray-500 hover:text-primary-600 transition">Financing</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-900 dark:text-white uppercase tracking-wider">Company
                        </h3>
                        <ul class="mt-4 space-y-4">
                            <li><a href="#" class="text-base text-gray-500 hover:text-primary-600 transition">About
                                    Us</a></li>
                            <li><a href="#"
                                    class="text-base text-gray-500 hover:text-primary-600 transition">Contact</a></li>
                            <li><a href="#"
                                    class="text-base text-gray-500 hover:text-primary-600 transition">Privacy</a></li>
                        </ul>
                    </div>
                </div>
                <div class="mt-8 border-t border-gray-100 dark:border-gray-700 pt-8 flex items-center justify-between">
                    <p class="text-base text-gray-400">&copy; {{ date('Y') }} Sky Motors Dublin. All rights reserved.
                    </p>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>