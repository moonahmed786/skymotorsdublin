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

                        <div class="relative" x-data="{ uploading: false, progress: 0 }" x-on:livewire-upload-start="uploading = true"
                            x-on:livewire-upload-finish="uploading = false" x-on:livewire-upload-error="uploading = false"
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
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
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
                                    class="px-6 py-3.5 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-200/60">
                            @foreach ($cars as $car)
                                <tr class="hover:bg-blue-50/30 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="h-12 w-20 flex-shrink-0">
                                            @if($car->mainImage)
                                                <img class="h-12 w-20 rounded object-cover" src="{{ Storage::url($car->mainImage->image_path) }}" alt="">
                                            @else
                                                <div class="h-12 w-20 rounded bg-slate-200 flex items-center justify-center text-slate-400">
                                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
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
                                            {{ $car->brand->name ?? $car->make->name ?? 'N/A' }}</div>
                                        <div class="text-sm text-slate-500">
                                            {{ $car->type->name ?? $car->model->name ?? 'N/A' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div
                                            class="text-sm text-slate-700 font-medium bg-slate-100 px-2 py-0.5 rounded inline-block">
                                            {{ $car->year_of_manufacture }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-bold text-slate-900">
                                            €{{ number_format($car->selling_price, 2) }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2.5 py-0.5 inline-flex text-xs font-bold rounded-full 
                                                    {{ $car->status === 'available' ? 'bg-emerald-100 text-emerald-700' : '' }}
                                                    {{ $car->status === 'sold' ? 'bg-slate-100 text-slate-600' : '' }}
                                                    {{ $car->status === 'reserved' ? 'bg-amber-100 text-amber-700' : '' }}
                                                    {{ $car->status === 'in_service' ? 'bg-blue-100 text-blue-700' : '' }}">
                                            {{ ucfirst(str_replace('_', ' ', $car->status)) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('admin.cars.edit', $car->id) }}"
                                            class="text-blue-600 hover:text-blue-800 mr-3 font-semibold transition-colors">Edit</a>
                                        <button 
                                            @click="
                                                Swal.fire({
                                                    title: 'Are you sure?',
                                                    text: 'You won\'t be able to revert this!',
                                                    icon: 'warning',
                                                    showCancelButton: true,
                                                    confirmButtonColor: '#d33',
                                                    cancelButtonColor: '#3085d6',
                                                    confirmButtonText: 'Yes, delete it!'
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        $wire.delete({{ $car->id }})
                                                    }
                                                })
                                            "
                                            class="text-rose-600 hover:text-rose-800 font-semibold transition-colors">Delete</button>
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