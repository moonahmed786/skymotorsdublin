<div
    class="flex flex-col h-full bg-gradient-to-b from-slate-900 via-slate-900 to-slate-800 text-white border-r border-slate-800 shadow-2xl">
    <!-- Logo Area -->
    <div class="flex h-16 shrink-0 items-center px-6 bg-slate-900/50 backdrop-blur border-b border-slate-800/50">
        <a href="{{ route('dashboard') }}"
            class="flex items-center gap-3 font-display font-bold text-xl tracking-wide group">
            <div
                class="relative flex items-center justify-center w-8 h-8 rounded-lg bg-gradient-to-br from-blue-500 to-blue-600 shadow-lg shadow-blue-500/30 group-hover:scale-105 transition-transform duration-300">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
            </div>
            <span class="text-white tracking-tight">Sky<span class="text-blue-400">Motors</span></span>
        </a>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 overflow-y-auto py-6 px-4 space-y-8">
        <!-- Main Section -->
        <div>
            <div class="text-xs font-semibold leading-6 text-slate-500 uppercase tracking-wider mb-2 px-2">Overview
            </div>
            <ul role="list" class="space-y-1">
                <li>
                    <a href="{{ route('dashboard') }}"
                        class="{{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-blue-600 to-blue-500 text-white shadow-md shadow-blue-500/20' : 'text-slate-400 hover:text-white hover:bg-white/5' }} group flex gap-x-3 rounded-xl p-2.5 text-sm leading-6 font-medium transition-all duration-200">
                        <svg class="{{ request()->routeIs('dashboard') ? 'text-white' : 'text-slate-500 group-hover:text-white' }} h-5 w-5 shrink-0 transition-colors"
                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ url('/') }}" target="_blank"
                        class="text-slate-400 hover:text-white hover:bg-white/5 group flex gap-x-3 rounded-xl p-2.5 text-sm leading-6 font-medium transition-all duration-200">
                        <svg class="text-slate-500 group-hover:text-white h-5 w-5 shrink-0 transition-colors"
                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S12 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S12 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418" />
                        </svg>
                        View Website
                    </a>
                </li>
            </ul>
        </div>

        <!-- Inventory Section -->
        <div>
            <div class="text-xs font-semibold leading-6 text-slate-500 uppercase tracking-wider mb-2 px-2">Inventory
            </div>
            <ul role="list" class="space-y-1">
                <li>
                    <a href="{{ route('admin.cars.index') }}"
                        class="{{ request()->routeIs('admin.cars.*') ? 'bg-slate-800 text-white shadow-sm' : 'text-slate-400 hover:text-white hover:bg-slate-800/50' }} group flex gap-x-3 rounded-lg p-2 text-sm leading-6 font-medium transition-all duration-200">
                        <svg class="{{ request()->routeIs('admin.cars.*') ? 'text-blue-500' : 'text-slate-500 group-hover:text-white' }} h-5 w-5 shrink-0 transition-colors"
                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.126-.504 1.126-1.125V14.25m-17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.126-.504 1.126-1.125V14.25m-17.25 4.5v-4.5c0-.621.504-1.125 1.125-1.125h15c.621 0 1.125.504 1.125 1.125v4.5m-16.5-6.75h16.5" />
                        </svg>
                        Cars
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.brands.index') }}"
                        class="{{ request()->routeIs('admin.brands.*') ? 'bg-slate-800 text-white shadow-sm' : 'text-slate-400 hover:text-white hover:bg-slate-800/50' }} group flex gap-x-3 rounded-lg p-2 text-sm leading-6 font-medium transition-all duration-200">
                        <svg class="{{ request()->routeIs('admin.brands.*') ? 'text-blue-500' : 'text-slate-500 group-hover:text-white' }} h-5 w-5 shrink-0 transition-colors"
                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                        </svg>
                        Brands
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.car-types.index') }}"
                        class="{{ request()->routeIs('admin.car-types.*') ? 'bg-slate-800 text-white shadow-sm' : 'text-slate-400 hover:text-white hover:bg-slate-800/50' }} group flex gap-x-3 rounded-lg p-2 text-sm leading-6 font-medium transition-all duration-200">
                        <svg class="{{ request()->routeIs('admin.car-types.*') ? 'text-blue-500' : 'text-slate-500 group-hover:text-white' }} h-5 w-5 shrink-0 transition-colors"
                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                        </svg>
                        Car Types
                    </a>
                </li>
            </ul>
        </div>

        {{-- @can('user.manage') --}}
        <!-- Access Control Section -->
        <div>
            <div class="text-xs font-semibold leading-6 text-slate-500 uppercase tracking-wider mb-2 px-2">Access
                Control</div>
            <ul role="list" class="space-y-1">
                <li>
                    <a href="{{ route('admin.users.index') }}"
                        class="{{ request()->routeIs('admin.users.*') ? 'bg-slate-800 text-white shadow-sm' : 'text-slate-400 hover:text-white hover:bg-slate-800/50' }} group flex gap-x-3 rounded-lg p-2 text-sm leading-6 font-medium transition-all duration-200">
                        <svg class="{{ request()->routeIs('admin.users.*') ? 'text-blue-500' : 'text-slate-500 group-hover:text-white' }} h-5 w-5 shrink-0 transition-colors"
                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                        </svg>
                        Users
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.roles.index') }}"
                        class="{{ request()->routeIs('admin.roles.*') ? 'bg-slate-800 text-white shadow-sm' : 'text-slate-400 hover:text-white hover:bg-slate-800/50' }} group flex gap-x-3 rounded-lg p-2 text-sm leading-6 font-medium transition-all duration-200">
                        <svg class="{{ request()->routeIs('admin.roles.*') ? 'text-blue-500' : 'text-slate-500 group-hover:text-white' }} h-5 w-5 shrink-0 transition-colors"
                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                        </svg>
                        Roles
                    </a>
                </li>
            </ul>
        </div>
        {{-- @endcan --}}
    </nav>

    <!-- User Profile (Bottom) -->
    <div class="border-t border-slate-800 p-4">
        <a href="{{ route('profile.edit') }}"
            class="group flex items-center gap-x-3 rounded-lg p-2 text-sm font-semibold leading-6 text-slate-400 hover:bg-slate-800 hover:text-white transition-all duration-200">
            <div
                class="h-8 w-8 rounded-full bg-slate-700 flex items-center justify-center text-white font-bold uppercase ring-2 ring-slate-800 group-hover:ring-blue-500 transition-all">
                {{ substr(Auth::user()->name, 0, 2) }}
            </div>
            <span class="sr-only">Your profile</span>
            <span aria-hidden="true">{{ Auth::user()->name }}</span>
        </a>
        <form method="POST" action="{{ route('logout') }}" class="mt-2">
            @csrf
            <button type="submit"
                class="w-full group flex items-center gap-x-3 rounded-lg p-2 text-sm font-semibold leading-6 text-slate-400 hover:bg-slate-800 hover:text-white transition-all duration-200">
                <svg class="h-5 w-5 shrink-0 text-slate-500 group-hover:text-white transition-colors" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                </svg>
                Log Out
            </button>
        </form>
    </div>
</div>