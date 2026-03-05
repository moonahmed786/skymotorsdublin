<div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-2">
                <!-- Image Gallery -->
                <div class="p-6 bg-gray-100 dark:bg-gray-700">
                    @if($car->images->count() > 0)
                        <div class="aspect-w-16 aspect-h-9 rounded-2xl overflow-hidden ring-1 ring-black/5 shadow-2xl">
                            <img src="/uploads/{{ $car->images->where('is_primary', true)->first()->image_path ?? $car->images->first()->image_path }}"
                                class="w-full h-full object-cover main-image" id="mainImage">
                        </div>
                    @else
                        <div class="flex items-center justify-center h-full bg-gray-300 dark:bg-gray-600 text-gray-400">
                            <span class="text-lg">No Image Available</span>
                        </div>
                    @endif

                    @if($car->images->count() > 1)
                        <div class="grid grid-cols-4 sm:grid-cols-6 gap-4 mt-6">
                            @foreach($car->images as $image)
                                <button onclick="document.getElementById('mainImage').src='/uploads/{{ $image->image_path }}'"
                                    class="aspect-w-1 aspect-h-1 rounded-xl overflow-hidden ring-2 ring-transparent hover:ring-blue-500 transition-all focus:outline-none bg-gray-100">
                                    <img src="/uploads/{{ $image->image_path }}" class="w-full h-full object-cover">
                                </button>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Car Details -->
                <div class="p-8 lg:p-12">
                    <div class="mb-6">
                        <div class="flex items-center gap-2 mb-2">
                            @if($car->brand && $car->brand->logo_path)
                                <img src="/uploads/{{ $car->brand->logo_path }}" class="h-8 w-8 object-contain">
                            @endif
                            <h2 class="text-sm font-semibold text-blue-600 uppercase tracking-wide">
                                {{ $car->brand->name ?? $car->make->name ?? 'Unknown Make' }}
                            </h2>
                        </div>
                        <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mb-2">
                            {{ $car->brand->name ?? $car->make->name }} {{ $car->type->name ?? $car->model->name }}
                        </h1>
                        <p class="text-lg text-gray-600 dark:text-gray-300">{{ $car->year_of_manufacture }} •
                            {{ number_format($car->mileage) }} km •
                            <span
                                class="font-mono bg-slate-100 dark:bg-slate-800 px-2 py-0.5 rounded text-sm">{{ $car->registration_number }}</span>
                        </p>
                    </div>

                    <div class="flex items-center justify-between mb-8 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Price</p>
                            <p class="text-3xl font-bold text-secondary-600 dark:text-secondary-400">
                                €{{ number_format($car->selling_price) }}</p>
                        </div>
                        <div>
                            <span
                                class="px-3 py-1 text-sm font-semibold rounded-full 
                                {{ $car->status === 'available' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ ucfirst($car->status) }}
                            </span>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-y-4 gap-x-8 mb-8">
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Engine Size</dt>
                            <dd class="text-base font-semibold text-gray-900 dark:text-white">{{ $car->engine_size }}
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Fuel Type</dt>
                            <dd class="text-base font-semibold text-gray-900 dark:text-white">
                                {{ ucfirst($car->fuel_type) }}
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Transmission</dt>
                            <dd class="text-base font-semibold text-gray-900 dark:text-white">
                                {{ ucfirst($car->transmission) }}
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Body Type</dt>
                            <dd class="text-base font-semibold text-gray-900 dark:text-white">
                                {{ $car->body_type ?? 'N/A' }}
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Color</dt>
                            <dd class="text-base font-semibold text-gray-900 dark:text-white">{{ ucfirst($car->color) }}
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">NCT Status</dt>
                            <dd class="text-base font-semibold text-gray-900 dark:text-white">
                                {{ $car->nct_status ?? 'N/A' }}
                                @if($car->nct_expiry_date)
                                    <span class="text-xs font-normal">({{ $car->nct_expiry_date->format('d M Y') }})</span>
                                @endif
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Radio Status</dt>
                            <dd class="text-base font-semibold text-gray-900 dark:text-white">
                                {{ $car->radio_status ?? 'N/A' }}
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Service Status</dt>
                            <dd class="text-base font-semibold text-gray-900 dark:text-white">
                                {{ $car->service_status ?? 'N/A' }}
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Valet Status</dt>
                            <dd class="text-base font-semibold text-gray-900 dark:text-white">
                                {{ $car->valet_status ?? 'N/A' }}
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Parking Location</dt>
                            <dd class="text-base font-semibold text-gray-900 dark:text-white">
                                {{ $car->parking_location ?? 'N/A' }}
                            </dd>
                        </div>
                        @if($car->collection_date)
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Collection Date</dt>
                                <dd class="text-base font-semibold text-gray-900 dark:text-white">
                                    {{ $car->collection_date->format('d M Y') }}
                                </dd>
                            </div>
                        @endif
                    </div>

                    @if($car->description)
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Description</h3>
                            <div class="prose dark:prose-invert text-gray-600 dark:text-gray-300">
                                {!! nl2br(e($car->description)) !!}
                            </div>
                        </div>
                    @endif

                    @if($car->features && count($car->features) > 0)
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Features</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach($car->features as $feature)
                                    <span
                                        class="px-3 py-1 bg-blue-50 dark:bg-blue-900 text-blue-700 dark:text-blue-300 rounded-full text-sm font-medium">
                                        {{ $feature }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="flex gap-4">
                        <button
                            class="flex-1 bg-primary-600 text-white font-bold py-3 px-6 rounded-lg hover:bg-primary-700 transition">
                            Enquire Now
                        </button>
                        <button
                            class="flex-1 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 font-bold py-3 px-6 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            Book Test Drive
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>