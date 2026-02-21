<div
    class="sticky top-0 z-40 flex h-16 shrink-0 items-center justify-between gap-x-4 border-b border-slate-200/60 bg-white/80 backdrop-blur-md px-4 shadow-sm sm:gap-x-6 sm:px-6 lg:px-8 transition-all duration-300">

    <!-- Mobile Menu Button -->
    <button type="button" class="-m-2.5 p-2.5 text-slate-700 lg:hidden hover:text-blue-600 transition-colors"
        @click="sidebarOpen = true">
        <span class="sr-only">Open sidebar</span>
        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
    </button>

    <!-- Header Title / Breadcrumbs (Placeholder) -->
    <div class="flex-1 flex items-center gap-x-4 self-stretch lg:gap-x-6">
        <h1 class="text-xl font-semibold text-slate-800 tracking-tight">Admin Dashboard</h1>
    </div>

    <!-- Right Section (Actions) -->
    <div class="flex items-center gap-x-4 lg:gap-x-6">
        <!-- Search could go here if needed -->
        <!-- Notifications could go here -->

        <div class="flex items-center gap-x-4 lg:hidden">
            <!-- Profile dropdown for mobile could go here if not in sidebar, 
                  but we put it in sidebar for better mobile UX usually. 
                  Leaving empty for now to keep clean. -->
        </div>
    </div>
</div>