<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl shadow-slate-200/60 rounded-xl border border-slate-200/60">
            <div class="p-6 sm:p-8">
                <!-- Header -->
                <div class="mb-8 text-center">
                    <h2 class="text-3xl font-bold text-slate-800 tracking-tight">Add New Car</h2>
                    <p class="text-slate-500 mt-2">Follow the steps below to list a new vehicle.</p>
                </div>

                <!-- Stepper -->
                <div x-data="{ currentStep: @entangle('currentStep') }" class="mb-10">
                    <div class="relative flex items-center justify-between w-full">
                        <div class="absolute left-0 top-1/2 transform -translate-y-1/2 w-full h-1 bg-slate-200 -z-10 rounded"></div>
                        <div class="absolute left-0 top-1/2 transform -translate-y-1/2 h-1 bg-blue-600 -z-10 rounded transition-all duration-500 ease-in-out"
                             :style="'width: ' + ((currentStep - 1) / ({{ $totalSteps }} - 1) * 100) + '%'"></div>

                        @foreach(range(1, $totalSteps) as $step)
                            <div class="relative flex flex-col items-center group">
                                <div class="w-10 h-10 flex items-center justify-center rounded-full font-bold text-sm transition-all duration-300 z-10 border-4"
                                    :class="currentStep >= {{ $step }} ? 'bg-blue-600 text-white border-blue-600 shadow-lg shadow-blue-500/40 transform scale-110' : 'bg-white text-slate-400 border-slate-200'">
                                    @if($currentStep > $step)
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    @else
                                        {{ $step }}
                                    @endif
                                </div>
                                <div class="absolute top-12 w-32 text-center text-xs font-semibold uppercase tracking-wider transition-colors duration-300"
                                     :class="currentStep >= {{ $step }} ? 'text-blue-600' : 'text-slate-400'">
                                    @if($step == 1) Branding @endif
                                    @if($step == 2) Details @endif
                                    @if($step == 3) Info @endif
                                    @if($step == 4) Images @endif
                                    @if($step == 5) Review @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <form wire:submit.prevent="submit" class="mt-12">
                    <!-- Step 1: Branding -->
                    @if($currentStep == 1)
                        <div wire:key="step-1" x-data class="space-y-8 animate-fade-in-up">
                            <div class="text-center mb-6">
                                <h3 class="text-xl font-semibold text-slate-800">Select Brand & Type</h3>
                                <p class="text-slate-500 text-sm">Choose the manufacturer and body type.</p>
                            </div>

                            <div class="space-y-4">
                                <label class="block text-sm font-medium text-slate-700">Brand</label>
                                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">
                                    @foreach($brands as $brand)
                                        <div wire:click="$set('brandId', {{ $brand->id }})"
                                            class="cursor-pointer border-2 rounded-xl p-4 flex flex-col items-center justify-center transition-all duration-200 hover:shadow-md
                                            {{ $brandId == $brand->id ? 'border-blue-500 bg-blue-50/50 ring-2 ring-blue-500 ring-opacity-50' : 'border-slate-200 hover:border-blue-300 hover:bg-slate-50' }}">
                                            @if($brand->logo_path)
                                                <img src="{{ Storage::url($brand->logo_path) }}" class="h-12 w-12 object-contain mb-3 drop-shadow-sm">
                                            @else
                                                <div class="h-12 w-12 bg-slate-200 rounded-full mb-3 flex items-center justify-center text-slate-400">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                </div>
                                            @endif
                                            <span class="text-sm font-semibold text-slate-700 text-center">{{ $brand->name }}</span>
                                        </div>
                                    @endforeach
                                </div>
                                @error('brandId') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            @if($brandId)
                                <div class="space-y-4 animate-fade-in">
                                    <label class="block text-sm font-medium text-slate-700">Car Type</label>
                                    @if($carTypes->count() > 0)
                                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                            @foreach($carTypes as $type)
                                                <div wire:click="$set('carTypeId', {{ $type->id }})"
                                                    class="cursor-pointer border-2 rounded-xl p-4 flex flex-col items-center justify-center transition-all duration-200 hover:shadow-md
                                                    {{ $carTypeId == $type->id ? 'border-blue-500 bg-blue-50/50 ring-2 ring-blue-500 ring-opacity-50' : 'border-slate-200 hover:border-blue-300 hover:bg-slate-50' }}">
                                                    @if($type->image_path)
                                                        <img src="{{ Storage::url($type->image_path) }}" class="h-12 w-auto object-contain mb-3 drop-shadow-sm">
                                                    @else
                                                        <div class="h-12 w-16 bg-slate-200 rounded mb-3 flex items-center justify-center text-slate-400">
                                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                        </div>
                                                    @endif
                                                    <span class="text-sm font-semibold text-slate-700 text-center">{{ $type->name }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="bg-amber-50 border border-amber-200 rounded-lg p-4 text-amber-700 text-sm">
                                            No car types found for this brand. Please add car types in the settings.
                                        </div>
                                    @endif
                                    @error('carTypeId') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>
                            @endif
                        </div>
                    @endif

                    <!-- Step 2: Technical Details -->
                    @if($currentStep == 2)
                        <div wire:key="step-2" class="animate-fade-in-up">
                            <div class="text-center mb-6">
                                <h3 class="text-xl font-semibold text-slate-800">Technical Specifications</h3>
                                <p class="text-slate-500 text-sm">Enter the technical details of the vehicle.</p>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-slate-50/50 p-6 rounded-xl border border-slate-100">
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1">Year</label>
                                    <input type="number" wire:model="year"
                                        class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm transition-all text-slate-700" placeholder="e.g. 2023">
                                    @error('year') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1">Engine Size</label>
                                    <input type="text" wire:model="engineSize"
                                        class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm transition-all text-slate-700" placeholder="e.g. 2.0L">
                                    @error('engineSize') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1">Fuel Type</label>
                                    <select wire:model="fuelType"
                                        class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm transition-all text-slate-700">
                                        <option value="">Select Option</option>
                                        <option value="petrol">Petrol</option>
                                        <option value="diesel">Diesel</option>
                                        <option value="hybrid">Hybrid</option>
                                        <option value="electric">Electric</option>
                                    </select>
                                    @error('fuelType') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1">Transmission</label>
                                    <select wire:model="transmission"
                                        class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm transition-all text-slate-700">
                                        <option value="">Select Option</option>
                                        <option value="manual">Manual</option>
                                        <option value="automatic">Automatic</option>
                                    </select>
                                    @error('transmission') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1">Mileage (km)</label>
                                    <input type="number" wire:model="mileage"
                                        class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm transition-all text-slate-700" placeholder="e.g. 50000">
                                    @error('mileage') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1">Color</label>
                                    <input type="text" wire:model="color"
                                        class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm transition-all text-slate-700" placeholder="e.g. Metallic Black">
                                    @error('color') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1">Number of Owners</label>
                                    <input type="number" wire:model="numberOfOwners"
                                        class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm transition-all text-slate-700">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1">NCT Expiry</label>
                                    <input type="date" wire:model="nctExpiry"
                                        class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm transition-all text-slate-700">
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Step 3: Info -->
                    @if($currentStep == 3)
                        <div wire:key="step-3" class="animate-fade-in-up">
                             <div class="text-center mb-6">
                                <h3 class="text-xl font-semibold text-slate-800">Vehicle Identification & Pricing</h3>
                                <p class="text-slate-500 text-sm">Set the price and description.</p>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-slate-50/50 p-6 rounded-xl border border-slate-100">
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1">Registration Number</label>
                                    <input type="text" wire:model="registrationNumber"
                                        class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm transition-all text-slate-700 uppercase" placeholder="e.g. 231-D-12345">
                                    @error('registrationNumber') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1">Chassis Number</label>
                                    <input type="text" wire:model="chassisNumber"
                                        class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm transition-all text-slate-700 uppercase" placeholder="VIN Number">
                                    @error('chassisNumber') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1">Buying Price (€)</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-slate-500 sm:text-sm">€</span>
                                        </div>
                                        <input type="number" step="0.01" wire:model="price_buying"
                                            class="pl-7 w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm transition-all text-slate-700" placeholder="0.00">
                                    </div>
                                    @error('price_buying') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1">Selling Price (€)</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-slate-500 sm:text-sm">€</span>
                                        </div>
                                        <input type="number" step="0.01" wire:model="price_selling"
                                            class="pl-7 w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm transition-all text-slate-700" placeholder="0.00">
                                    </div>
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-slate-700 mb-1">Description</label>
                                    <textarea wire:model="description" rows="4"
                                        class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm transition-all text-slate-700" placeholder="Detailed description of the vehicle..."></textarea>
                                </div>
                                <div class="md:col-span-2">
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input type="checkbox" wire:model="isPublished" class="rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                        <span class="ml-2 text-sm font-medium text-slate-700">Publish Immediately</span>
                                    </label>
                                    <p class="text-xs text-slate-500 mt-1 ml-6">If checked, the car will be visible to the public immediately.</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Step 4: Images -->
                    @if($currentStep == 4)
                        <div wire:key="step-4" class="space-y-8 animate-fade-in-up">
                            <div class="text-center mb-6">
                                <h3 class="text-xl font-semibold text-slate-800">Vehicle Gallery</h3>
                                <p class="text-slate-500 text-sm">Upload high-quality images of the vehicle.</p>
                            </div>

                            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                                <!-- Main Image -->
                                <div class="lg:col-span-1">
                                    <label class="block text-sm font-medium text-slate-700 mb-2">Main Image (Thumbnail)</label>
                                    <div class="relative group">
                                        <label
                                            class="flex flex-col items-center justify-center w-full h-64 border-2 border-slate-300 border-dashed rounded-xl cursor-pointer bg-slate-50 hover:bg-slate-100 hover:border-blue-400 transition-all duration-200 overflow-hidden">
                                            @if ($mainImage)
                                                <img src="{{ $mainImage->temporaryUrl() }}" class="w-full h-full object-cover">
                                                <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                                    <span class="text-white font-medium">Change Image</span>
                                                </div>
                                            @else
                                                <div class="flex flex-col items-center justify-center pt-5 pb-6 text-slate-400">
                                                    <svg class="w-10 h-10 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                    <p class="mb-2 text-sm"><span class="font-semibold text-blue-600">Click to upload</span></p>
                                                    <p class="text-xs">SVG, PNG, JPG or GIF</p>
                                                </div>
                                            @endif
                                            <input type="file" wire:model="mainImage" class="hidden" accept="image/*" />
                                        </label>
                                    </div>
                                    @error('mainImage') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>

                                <!-- Gallery Images -->
                                <div class="lg:col-span-2">
                                    <label class="block text-sm font-medium text-slate-700 mb-2">Gallery Images</label>
                                    <label
                                        class="flex flex-col items-center justify-center w-full h-32 border-2 border-slate-300 border-dashed rounded-xl cursor-pointer bg-slate-50 hover:bg-slate-100 hover:border-blue-400 transition-all duration-200 mb-4">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6 text-slate-400">
                                            <svg class="w-8 h-8 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                            <p class="text-sm"><span class="font-semibold text-blue-600">Add more images</span> to the gallery</p>
                                        </div>
                                        <input type="file" wire:model="images" multiple class="hidden" accept="image/*" />
                                    </label>

                                    @if ($images)
                                        <div class="grid grid-cols-3 sm:grid-cols-4 gap-4">
                                            @foreach($images as $img)
                                                <div class="relative group aspect-square rounded-lg overflow-hidden border border-slate-200 shadow-sm">
                                                    <img src="{{ $img->temporaryUrl() }}" class="w-full h-full object-cover">
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Step 5: Review -->
                    @if($currentStep == 5)
                        <div wire:key="step-5" class="animate-fade-in-up">
                            <div class="text-center mb-6">
                                <h3 class="text-xl font-semibold text-slate-800">Review & Confirm</h3>
                                <p class="text-slate-500 text-sm">Please verify all details before submitting.</p>
                            </div>

                            <div class="bg-slate-50 rounded-xl border border-slate-200 overflow-hidden">
                                <dl class="divide-y divide-slate-200">
                                    <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 hover:bg-slate-100/50 transition-colors">
                                        <dt class="text-sm font-medium text-slate-500">Brand & Model</dt>
                                        <dd class="mt-1 text-sm text-slate-900 sm:col-span-2 sm:mt-0 font-semibold">{{ $brands->find($brandId)?->name }} - {{ $carTypes->where('id', $carTypeId)->first()?->name }}</dd>
                                    </div>
                                    <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 hover:bg-slate-100/50 transition-colors">
                                        <dt class="text-sm font-medium text-slate-500">Year</dt>
                                        <dd class="mt-1 text-sm text-slate-900 sm:col-span-2 sm:mt-0">{{ $year }}</dd>
                                    </div>
                                    <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 hover:bg-slate-100/50 transition-colors">
                                        <dt class="text-sm font-medium text-slate-500">Fuel & Transmission</dt>
                                        <dd class="mt-1 text-sm text-slate-900 sm:col-span-2 sm:mt-0 uppercase">{{ $fuelType }} / {{ $transmission }}</dd>
                                    </div>
                                    <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 hover:bg-slate-100/50 transition-colors">
                                        <dt class="text-sm font-medium text-slate-500">Registration</dt>
                                        <dd class="mt-1 text-sm text-slate-900 sm:col-span-2 sm:mt-0 font-mono">{{ $registrationNumber }}</dd>
                                    </div>
                                    <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 hover:bg-slate-100/50 transition-colors">
                                        <dt class="text-sm font-medium text-slate-500">Selling Price</dt>
                                        <dd class="mt-1 text-sm text-blue-600 sm:col-span-2 sm:mt-0 font-bold text-lg">€{{ number_format((float)$price_selling, 2) }}</dd>
                                    </div>
                                </dl>
                            </div>
                        </div>
                    @endif

                    <div class="mt-10 pt-6 border-t border-slate-100 flex justify-between items-center">
                        <div>
                            @if($currentStep > 1)
                                <button type="button" wire:click="previousStep"
                                    class="inline-flex items-center px-6 py-3 border border-slate-300 shadow-sm text-base font-medium rounded-lg text-slate-700 bg-white hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all">
                                    <svg class="w-5 h-5 mr-2 -ml-1 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                                    Previous
                                </button>
                            @endif
                        </div>

                        <div>
                            @if($currentStep < $totalSteps)
                                <button type="button" wire:click="nextStep"
                                    class="inline-flex items-center px-8 py-3 border border-transparent text-base font-medium rounded-lg shadow-lg shadow-blue-500/30 text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all transform hover:-translate-y-0.5">
                                    Next Step
                                    <svg class="w-5 h-5 ml-2 -mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </button>
                            @else
                                <button type="submit"
                                    class="inline-flex items-center px-8 py-3 border border-transparent text-base font-medium rounded-lg shadow-lg shadow-emerald-500/30 text-white bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-all transform hover:-translate-y-0.5">
                                    <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    Submit Listing
                                </button>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <style>
        .animate-fade-in-up {
            animation: fadeInUp 0.5s ease-out forwards;
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-fade-in {
            animation: fadeIn 0.4s ease-out forwards;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</div>