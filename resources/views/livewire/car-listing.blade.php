<div class="bg-gray-50 dark:bg-gray-900 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row gap-8">
            <!-- Sidebar Filters -->
            <!-- Sidebar Filters -->
            <div class="w-full md:w-1/4">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm sticky top-24">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Filter Vehicles</h3>
                    
                    <div class="space-y-6">
                        <!-- Search -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Search</label>
                            <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search make or model..." class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>

                        <!-- Brand Filter -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Brand</label>
                            <select wire:model.live="selectedBrand" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">All Brands</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Car Type Filter (Dependent) -->
                        @if($selectedBrand && count($carTypes) > 0)
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Model / Type</label>
                            <select wire:model.live="selectedCarType" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">All Models</option>
                                @foreach($carTypes as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif

                        <!-- Year Range -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Year Range</label>
                            <div class="flex gap-2">
                                <input wire:model.live.debounce.500ms="minYear" type="number" placeholder="From" class="w-1/2 rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <input wire:model.live.debounce.500ms="maxYear" type="number" placeholder="To" class="w-1/2 rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                        </div>

                        <!-- Price Range -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Price Range (€)</label>
                            <div class="flex gap-2">
                                <input wire:model.live.debounce.500ms="minPrice" type="number" placeholder="Min" class="w-1/2 rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <input wire:model.live.debounce.500ms="maxPrice" type="number" placeholder="Max" class="w-1/2 rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                        </div>

                        <!-- Fuel Type -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Fuel Type</label>
                            <select wire:model.live="fuelType" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Any</option>
                                <option value="petrol">Petrol</option>
                                <option value="diesel">Diesel</option>
                                <option value="hybrid">Hybrid</option>
                                <option value="electric">Electric</option>
                            </select>
                        </div>

                        <!-- Transmission -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Transmission</label>
                            <select wire:model.live="transmission" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Any</option>
                                <option value="manual">Manual</option>
                                <option value="automatic">Automatic</option>
                            </select>
                        </div>

                        <!-- Body Type -->
                         <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Body Type</label>
                            <input wire:model.live.debounce.500ms="bodyType" type="text" placeholder="e.g. Sedan, SUV" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>

                         <div class="pt-4">
                            <button wire:click="$set('search', ''); $set('selectedBrand', ''); $set('selectedCarType', ''); $set('minPrice', ''); $set('maxPrice', ''); $set('minYear', ''); $set('maxYear', ''); $set('fuelType', ''); $set('transmission', ''); $set('bodyType', '');" class="w-full px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600">
                                Reset Filters
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Car Grid -->
            <div class="w-full md:w-3/4">
                <div class="mb-4 flex justify-between items-center">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Available Vehicles</h2>
                    <span class="text-sm text-gray-500 dark:text-gray-400">Showing {{ $cars->firstItem() ?? 0 }} - {{ $cars->lastItem() ?? 0 }} of {{ $cars->total() }} results</span>
                </div>

                @if($cars->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($cars as $car)
                            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow-md transition duration-200 overflow-hidden flex flex-col h-full border border-gray-100 dark:border-gray-700 cursor-pointer"
                                 x-on:click="window.location.href = '{{ route('cars.show', $car->id) }}'">
                                <div class="aspect-[16/10] bg-gray-200 dark:bg-gray-700 relative overflow-hidden group">
                                    @if($car->images->count() > 0)
                                        <img src="/uploads/{{ $car->images->first()->image_path }}" 
                                             alt="{{ $car->brand->name ?? $car->make->name ?? '' }} {{ $car->type->name ?? $car->model->name ?? '' }}" 
                                             class="w-full h-full object-cover transform group-hover:scale-105 transition duration-500">
                                    @else
                                        <div class="flex items-center justify-center h-full text-gray-400">
                                            <svg class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    @endif
                                    <div class="absolute top-2 right-2 bg-primary-600 text-white text-xs font-bold px-2 py-1 rounded">
                                        {{ $car->year_of_manufacture }}
                                    </div>
                                    @if($car->brand && $car->brand->logo_path)
                                        <div class="absolute bottom-2 left-2 bg-white/80 p-1 rounded-full">
                                            <img src="/uploads/{{ $car->brand->logo_path }}" class="h-6 w-6 object-contain">
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="p-4 flex flex-col flex-grow">
                                    <div class="mb-2">
                                        <h3 class="text-lg font-bold text-gray-900 dark:text-white leading-tight">
                                            {{ $car->brand->name ?? $car->make->name ?? 'Unknown' }} 
                                            {{ $car->type->name ?? $car->model->name ?? 'Vehicle' }}
                                        </h3>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $car->color }} • {{ number_format($car->mileage) }} km</p>
                                    </div>
                                    
                                    <div class="mt-auto pt-4 border-t border-gray-100 dark:border-gray-700 flex items-center justify-between">
                                        <span class="text-xl font-bold text-secondary-600 dark:text-secondary-400">
                                            €{{ number_format($car->selling_price) }}
                                        </span>
                                        <a href="{{ route('cars.show', $car->id) }}" class="text-sm font-medium text-primary-600 dark:text-primary-400 hover:text-primary-800 transition">
                                            View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="mt-8">
                        {{ $cars->links() }}
                    </div>
                @else
                    <div class="text-center py-12 bg-white dark:bg-gray-800 rounded-lg border border-gray-100 dark:border-gray-700">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No vehicles found</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Try adjusting your filters or search terms.</p>
                        <div class="mt-6">
                            <button wire:click="$set('search', '')" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                Clear Filters
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
