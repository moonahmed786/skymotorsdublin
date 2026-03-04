<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div
            class="bg-white overflow-hidden shadow-xl shadow-slate-200/60 rounded-xl border border-slate-200/60 transition-all duration-300 hover:shadow-2xl hover:shadow-slate-200/40">
            <div class="p-6">
                <!-- Header -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                    <h2 class="text-xl font-bold text-slate-800 tracking-tight">Car Management</h2>
                    <div class="flex items-center gap-2">
                        <button wire:click="downloadSample" wire:loading.attr="disabled"
                            class="inline-flex items-center px-3 py-2 bg-slate-100 border border-slate-300 rounded-lg font-semibold text-xs text-slate-700 uppercase tracking-widest hover:bg-slate-200 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150">
                            Sample
                        </button>
                        <button wire:click="export" wire:loading.attr="disabled"
                            class="inline-flex items-center px-4 py-2 bg-slate-800 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-slate-700 active:bg-slate-900 focus:outline-none focus:border-slate-900 focus:ring ring-slate-300 disabled:opacity-25 transition ease-in-out duration-150">
                            <span wire:loading.remove wire:target="export">Export</span>
                            <span wire:loading wire:target="export">Exporting...</span>
                        </button>

                        <div class="relative" x-data="{ uploading: false, progress: 0 }"
                            x-on:livewire-upload-start="uploading = true"
                            x-on:livewire-upload-finish="uploading = false"
                            x-on:livewire-upload-error="uploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress">
                            <input type="file" wire:model="excelFile" class="hidden" id="excel-upload"
                                accept=".xlsx,.xls,.csv" wire:change="import">
                            <label for="excel-upload"
                                class="cursor-pointer inline-flex items-center px-4 py-2 bg-white border border-slate-300 rounded-lg font-semibold text-xs text-slate-700 uppercase tracking-widest shadow-sm hover:text-slate-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-slate-800 active:bg-slate-50 disabled:opacity-25 transition ease-in-out duration-150">
                                Import
                            </label>
                        </div>

                        <a href="{{ route('admin.cars.wizard') }}"
                            class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:from-blue-500 hover:to-indigo-500 shadow-lg shadow-blue-500/30 transition-all duration-200 transform hover:-translate-y-0.5">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Add Car
                        </a>
                    </div>
                </div>

                <!-- Messages -->
                @if (session()->has('message'))
                    <div class="bg-emerald-50/80 backdrop-blur border border-emerald-200 text-emerald-700 px-4 py-3 rounded-lg relative mb-6 flex items-center shadow-sm"
                        role="alert">
                        <svg class="w-5 h-5 mr-2 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="block sm:inline font-medium">{{ session('message') }}</span>
                    </div>
                @endif

                <!-- Search -->
                <div class="mb-6 relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input wire:model.live="search" type="text" placeholder="Search by Reg, Brand, Model..."
                        class="w-full pl-10 pr-4 py-2.5 bg-slate-50/50 border border-slate-200 text-slate-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all shadow-sm placeholder:text-slate-400">
                </div>

                <!-- Table -->
                <div class="overflow-x-auto rounded-lg border border-slate-200/60">
                    <table class="min-w-full divide-y divide-slate-200/60">
                        <thead class="bg-slate-50/80 backdrop-blur-sm">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                    Image
                                </th>
                                <x-table-sort-header label="Reg / Chassis" field="registration_number"
                                    :sortField="$sortField" :sortDirection="$sortDirection" />
                                <x-table-sort-header label="Brand / Type" field="brand.name" :sortField="$sortField"
                                    :sortDirection="$sortDirection" />
                                <x-table-sort-header label="Year" field="year_of_manufacture" :sortField="$sortField"
                                    :sortDirection="$sortDirection" />
                                <x-table-sort-header label="Price (Sell)" field="selling_price" :sortField="$sortField"
                                    :sortDirection="$sortDirection" />
                                <x-table-sort-header label="Status" field="status" :sortField="$sortField"
                                    :sortDirection="$sortDirection" />
                                <th scope="col"
                                    class="px-6 py-3.5 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-200/60">
                            @foreach ($cars as $car)
                                <tr class="hover:bg-blue-50/30 transition-colors duration-150 cursor-pointer"
                                    x-on:click="window.location.href = '{{ route('cars.show', $car->id) }}'">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="h-12 w-20 flex-shrink-0">
                                            @php
                                                $displayImage = $car->mainImage ?? $car->images->first();
                                            @endphp
                                            @if($displayImage)
                                                <img class="h-12 w-20 rounded object-cover shadow-sm border border-slate-100"
                                                    src="{{ Storage::disk('public')->url($displayImage->image_path) }}" alt="">
                                            @else
                                                <div
                                                    class="h-12 w-20 rounded bg-slate-50 border border-slate-100 flex items-center justify-center text-slate-300">
                                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-semibold text-slate-900">{{ $car->registration_number }}
                                        </div>
                                        <div class="text-xs text-slate-500 font-mono mt-0.5">{{ $car->chassis_number }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-slate-900">
                                            {{ $car->brand->name ?? $car->make->name ?? 'N/A' }}
                                        </div>
                                        <div class="text-sm text-slate-500">
                                            {{ $car->type->name ?? $car->model->name ?? 'N/A' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div
                                            class="text-sm text-slate-700 font-medium bg-slate-100 px-2 py-0.5 rounded inline-block">
                                            {{ $car->year_of_manufacture }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-bold text-slate-900">
                                            €{{ number_format($car->selling_price, 2) }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $statusConfig = [
                                                'available' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
                                                'sold' => 'bg-slate-900 text-white border-slate-800',
                                                'reserved' => 'bg-amber-50 text-amber-600 border-amber-100',
                                                'in_service' => 'bg-blue-50 text-blue-600 border-blue-100'
                                            ];
                                            $currentStatusClasses = $statusConfig[$car->status] ?? 'bg-slate-50 text-slate-600 border-slate-100';
                                        @endphp
                                        <div class="relative group/status" x-on:click.stop>
                                            <select wire:change="updateStatus({{ $car->id }}, $event.target.value)"
                                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                                <option value="available" {{ $car->status === 'available' ? 'selected' : '' }}>Available</option>
                                                <option value="sold" {{ $car->status === 'sold' ? 'selected' : '' }}>Sold</option>
                                                <option value="reserved" {{ $car->status === 'reserved' ? 'selected' : '' }}>Reserved</option>
                                                <option value="in_service" {{ $car->status === 'in_service' ? 'selected' : '' }}>In Service</option>
                                            </select>
                                            <span @class([
                                                'inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest border shadow-sm transition-all duration-300 group-hover/status:scale-105',
                                                $currentStatusClasses
                                            ])>
                                                <span class="w-1.5 h-1.5 rounded-full mr-2 {{ $car->status === 'sold' ? 'bg-white' : 'bg-current shadow-[0_0_8px_currentColor]' }}"></span>
                                                {{ str_replace('_', ' ', $car->status) }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                        <div x-data="{ open: false }" class="relative inline-block text-left" x-on:click.stop>
                                            <button @click="open = !open" @click.away="open = false" 
                                                class="flex items-center justify-center w-9 h-9 rounded-xl bg-slate-50 text-slate-500 hover:bg-blue-50 hover:text-blue-600 transition-all duration-300 shadow-sm border border-slate-200/60">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 5v.01M12 12v.01M12 19v.01"></path></svg>
                                            </button>
                                            
                                            <div x-show="open" 
                                                x-transition:enter="transition ease-out duration-200"
                                                x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                                                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                                x-transition:leave="transition ease-in duration-75"
                                                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                                                x-transition:leave-end="opacity-0 scale-95 translate-y-2"
                                                class="absolute right-0 mt-3 w-48 rounded-2xl bg-white shadow-2xl shadow-slate-900/10 border border-slate-100 ring-1 ring-black ring-opacity-5 focus:outline-none z-50 overflow-hidden"
                                                style="display: none;">
                                                <div class="py-1">
                                                    <a href="{{ route('admin.cars.edit', $car->id) }}" class="group flex items-center px-4 py-3 text-sm font-bold text-slate-700 hover:bg-blue-50 hover:text-blue-700 transition-colors">
                                                        <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center mr-3 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                        </div>
                                                        Edit Car
                                                    </a>
                                                    <button @click="
                                                            open = false;
                                                            Swal.fire({
                                                                title: 'Are you sure?',
                                                                text: 'Deleted cars cannot be recovered!',
                                                                icon: 'warning',
                                                                showCancelButton: true,
                                                                confirmButtonColor: '#ef4444',
                                                                cancelButtonColor: '#64748b',
                                                                confirmButtonText: 'Yes, delete it!',
                                                                customClass: {
                                                                    popup: 'rounded-[1.5rem]',
                                                                    confirmButton: 'rounded-xl font-bold px-6',
                                                                    cancelButton: 'rounded-xl font-bold px-6'
                                                                }
                                                            }).then((result) => {
                                                                if (result.isConfirmed) {
                                                                    $wire.delete({{ $car->id }})
                                                                }
                                                            })
                                                        " class="group w-full flex items-center px-4 py-3 text-sm font-bold text-rose-600 hover:bg-rose-50 transition-colors">
                                                        <div class="w-8 h-8 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center mr-3 group-hover:bg-rose-600 group-hover:text-white transition-colors">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                        </div>
                                                        Delete Car
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $cars->links() }}
                </div>
            </div>
        </div>
    </div>
</div>