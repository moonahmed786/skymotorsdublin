<x-app-layout>
    <div class="relative isolate overflow-hidden">
        <!-- Hero Section -->
        <div class="relative bg-white dark:bg-gray-900 pb-16 sm:pb-24 lg:pb-32">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 relative pt-20 sm:pt-24 lg:pt-32">
                <div class="text-center mx-auto max-w-3xl">
                    <h1
                        class="text-4xl font-display font-bold tracking-tight text-gray-900 dark:text-white sm:text-6xl mb-6">
                        Drive the <span
                            class="text-transparent bg-clip-text bg-gradient-to-r from-primary-600 to-secondary-500">Extraordinary</span>
                    </h1>
                    <p class="mt-4 text-xl leading-8 text-gray-600 dark:text-gray-300">
                        Experience the pinnacle of automotive luxury and performance. At Sky Motors Dublin, we don't
                        just sell cars; we curate journeys.
                    </p>
                    <div class="mt-10 flex items-center justify-center gap-x-6">
                        <a href="#cars"
                            class="rounded-full bg-primary-600 px-8 py-3.5 text-sm font-semibold text-white shadow-sm hover:bg-primary-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600 transition-all transform hover:scale-105">
                            Browse Inventory
                        </a>
                        <a href="#"
                            class="text-sm font-semibold leading-6 text-gray-900 dark:text-white hover:text-primary-600 dark:hover:text-primary-400 transition">
                            Book a Test Drive <span aria-hidden="true">→</span>
                        </a>
                    </div>
                </div>

                <!-- Hero Image/Graphic Placeholder -->
                <div
                    class="mt-16 sm:mt-24 rounded-2xl bg-gradient-to-tr from-gray-900 to-gray-800 p-2 sm:p-4 ring-1 ring-white/10 shadow-2xl overflow-hidden aspect-[16/7] relative flex items-center justify-center">
                    <div
                        class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?ixlib=rb-4.0.3&auto=format&fit=crop&w=2560&q=80')] bg-cover bg-center opacity-50 mix-blend-overlay">
                    </div>
                    <div class="relative z-10 text-center">
                        <p class="text-gray-400 uppercase tracking-widest text-sm font-semibold">Premium Selection</p>
                        <h2 class="text-white text-3xl sm:text-5xl font-display font-bold mt-2">The 2024 Collection</h2>
                    </div>
                </div>
            </div>

            <!-- Background Decoration -->
            <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]"
                aria-hidden="true">
                <div class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-primary-200 to-secondary-200 opacity-30 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]"
                    style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
                </div>
            </div>
        </div>

        <!-- Livewire Car Listing Section -->
        <div id="cars" class="scroll-mt-24">
            <livewire:car-listing />
        </div>

        <!-- CTA Section -->
        <div class="relative isolate mt-16 px-6 py-24 sm:mt-24 sm:py-32 lg:px-8">
            <svg class="absolute inset-0 -z-10 h-full w-full stroke-gray-200 [mask-image:radial-gradient(100%_100%_at_top_right,white,transparent)]"
                aria-hidden="true">
                <defs>
                    <pattern id="0787a7c5-978c-4f66-83c7-11c213f99cb7" width="200" height="200" x="50%" y="-1"
                        patternUnits="userSpaceOnUse">
                        <path d="M.5 200V.5H200" fill="none" />
                    </pattern>
                </defs>
                <rect width="100%" height="100%" stroke-width="0" fill="url(#0787a7c5-978c-4f66-83c7-11c213f99cb7)" />
            </svg>
            <div class="mx-auto max-w-2xl text-center">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl font-display">
                    Ready to find your match?</h2>
                <p class="mx-auto mt-6 max-w-xl text-lg leading-8 text-gray-600 dark:text-gray-300">
                    Visit our showroom in Dublin or browse our extensive inventory online. Your perfect drive awaits.
                </p>
                <div class="mt-10 flex items-center justify-center gap-x-6">
                    <a href="#"
                        class="rounded-full bg-slate-900 px-8 py-3.5 text-sm font-semibold text-white shadow-sm hover:bg-slate-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-slate-600 transition">Contact
                        Us</a>
                    <a href="#"
                        class="text-sm font-semibold leading-6 text-gray-900 dark:text-white hover:text-primary-600 transition">View
                        Location <span aria-hidden="true">→</span></a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>