<div>

        <!-- Dashboard Header -->
        <div class="mb-10 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
            <div class="animate-fade-in">
                <h1 class="text-4xl font-extrabold tracking-tight text-slate-900 leading-tight">
                    Analytics <span class="text-blue-600">Overview</span>
                </h1>
                <p class="mt-2 text-base text-slate-500 font-medium">Performance insights and real-time inventory tracking.</p>
            </div>

            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-4 bg-white p-2 rounded-2xl shadow-sm border border-slate-200/60 transition-all hover:shadow-md">
                <div class="relative">
                    <select wire:model.live="filter"
                        class="w-full sm:w-auto text-sm border-0 focus:ring-0 rounded-xl py-2.5 pl-4 pr-10 text-slate-700 font-bold cursor-pointer bg-slate-50 hover:bg-slate-100 transition-colors">
                        <option value="7days">Last 7 Days</option>
                        <option value="monthly">This Month</option>
                        <option value="yearly">This Year</option>
                        <option value="custom">Custom Range</option>
                    </select>
                </div>

                @if($filter === 'custom')
                    <div class="flex items-center gap-3 animate-fade-in-down px-2">
                        <input type="date" wire:model.live="startDate"
                            class="text-sm border-0 bg-slate-50 rounded-xl py-2 px-3 focus:ring-2 focus:ring-blue-500/20 font-semibold text-slate-700">
                        <span class="text-slate-400 font-bold text-xs">TO</span>
                        <input type="date" wire:model.live="endDate"
                            class="text-sm border-0 bg-slate-50 rounded-xl py-2 px-3 focus:ring-2 focus:ring-blue-500/20 font-semibold text-slate-700">
                    </div>
                @else
                    <div class="hidden md:flex items-center px-4 bg-blue-50/50 rounded-xl py-2 border border-blue-100/50">
                        <svg class="w-4 h-4 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <span class="text-xs font-bold text-blue-700 uppercase tracking-wider">
                            {{ \Carbon\Carbon::parse($startDate)->format('M d') }} — {{ \Carbon\Carbon::parse($endDate)->format('M d, Y') }}
                        </span>
                    </div>
                @endif
            </div>
        </div>

        <!-- Metric Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <!-- Total Sales -->
            <div class="relative group bg-white rounded-[2rem] p-8 shadow-sm border border-slate-200/60 transition-all duration-500 hover:shadow-2xl hover:shadow-blue-500/15 hover:-translate-y-2 overflow-hidden">
                <div class="absolute -right-6 -top-6 w-32 h-32 bg-blue-50 rounded-full group-hover:scale-150 transition-transform duration-700 opacity-40"></div>
                <div class="absolute -left-10 -bottom-10 w-40 h-40 bg-indigo-50 rounded-full group-hover:scale-125 transition-transform duration-700 opacity-30"></div>
                <div class="relative flex flex-col h-full">
                    <div class="flex items-center justify-between mb-6">
                        <div class="w-14 h-14 bg-gradient-to-br from-blue-600 to-indigo-700 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-blue-500/30 group-hover:rotate-12 transition-transform duration-500">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div @class([
                            'flex items-center gap-1 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest border transition-colors bg-white/50 backdrop-blur-sm',
                            'text-emerald-600 border-emerald-100 shadow-sm shadow-emerald-500/5' => $salesTrend >= 0,
                            'text-rose-600 border-rose-100 shadow-sm shadow-rose-500/5' => $salesTrend < 0,
                        ])>
                            {{ $salesTrend >= 0 ? '+' : '' }}{{ $salesTrend }}%
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="{{ $salesTrend >= 0 ? 'M5 10l7-7m0 0l7 7m-7-7v18' : 'M19 14l-7 7m0 0l-7-7m7 7V3' }}"></path></svg>
                        </div>
                    </div>
                    <div>
                        <p class="text-[11px] font-extrabold text-blue-400 uppercase tracking-[0.2em] mb-1">Portfolio Performance</p>
                        <h3 class="text-4xl font-black text-slate-900 tracking-tighter group-hover:text-blue-600 transition-colors">€{{ number_format($totalSales, 0) }}</h3>
                    </div>
                </div>
            </div>

            <!-- Total Inventory -->
            <div class="relative group bg-white rounded-[2rem] p-8 shadow-sm border border-slate-200/60 transition-all duration-500 hover:shadow-2xl hover:shadow-violet-500/15 hover:-translate-y-2 overflow-hidden">
                <div class="absolute -right-6 -top-6 w-32 h-32 bg-violet-50 rounded-full group-hover:scale-150 transition-transform duration-700 opacity-40"></div>
                <div class="absolute right-4 bottom-4 text-[60px] font-black text-slate-50 select-none group-hover:text-violet-50 transition-colors duration-500">FLEET</div>
                <div class="relative flex flex-col h-full">
                    <div class="flex items-center justify-between mb-6">
                        <div class="w-14 h-14 bg-gradient-to-br from-violet-600 to-purple-700 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-violet-500/30 group-hover:rotate-12 transition-transform duration-500">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        </div>
                        <div class="px-3 py-1 bg-violet-50/80 backdrop-blur-sm text-violet-600 border border-violet-100 rounded-full text-[10px] font-black uppercase tracking-widest shadow-sm shadow-violet-500/5">
                            Inventory
                        </div>
                    </div>
                    <div>
                        <p class="text-[11px] font-extrabold text-violet-400 uppercase tracking-[0.2em] mb-1">Total Assets</p>
                        <h3 class="text-4xl font-black text-slate-900 tracking-tighter group-hover:text-violet-600 transition-colors">{{ number_format($totalCars) }}</h3>
                    </div>
                </div>
            </div>

            <!-- Available -->
            <div class="relative group bg-white rounded-[2rem] p-8 shadow-sm border border-slate-200/60 transition-all duration-500 hover:shadow-2xl hover:shadow-emerald-500/15 hover:-translate-y-2 overflow-hidden">
                <div class="absolute -right-6 -top-6 w-32 h-32 bg-emerald-50 rounded-full group-hover:scale-150 transition-transform duration-700 opacity-40"></div>
                <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-48 h-48 bg-emerald-50/30 rounded-full blur-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                <div class="relative flex flex-col h-full">
                    <div class="flex items-center justify-between mb-6">
                        <div class="w-14 h-14 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-emerald-500/30 group-hover:rotate-12 transition-transform duration-500">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div class="px-3 py-1 bg-emerald-50/80 backdrop-blur-sm text-emerald-600 border border-emerald-100 rounded-full text-[10px] font-black uppercase tracking-widest shadow-sm shadow-emerald-500/5">
                            Available
                        </div>
                    </div>
                    <div>
                        <p class="text-[11px] font-extrabold text-emerald-400 uppercase tracking-[0.2em] mb-1">Active Stock</p>
                        <h3 class="text-4xl font-black text-slate-900 tracking-tighter group-hover:text-emerald-600 transition-colors">{{ number_format($availableCars) }}</h3>
                    </div>
                </div>
            </div>

            <!-- Sold -->
            <div class="relative group bg-white rounded-[2rem] p-8 shadow-sm border border-slate-200/60 transition-all duration-500 hover:shadow-2xl hover:shadow-rose-500/15 hover:-translate-y-2 overflow-hidden">
                <div class="absolute -right-6 -top-6 w-32 h-32 bg-rose-50 rounded-full group-hover:scale-150 transition-transform duration-700 opacity-40"></div>
                <div class="absolute inset-0 bg-gradient-to-br from-rose-50/0 via-rose-50/0 to-rose-50/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="relative flex flex-col h-full">
                    <div class="flex items-center justify-between mb-6">
                        <div class="w-14 h-14 bg-gradient-to-br from-rose-500 to-orange-600 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-rose-500/30 group-hover:rotate-12 transition-transform duration-500">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        </div>
                        <div class="px-3 py-1 bg-rose-50/80 backdrop-blur-sm text-rose-600 border border-rose-100 rounded-full text-[10px] font-black uppercase tracking-widest shadow-sm shadow-rose-500/5">
                            Closed
                        </div>
                    </div>
                    <div>
                        <p class="text-[11px] font-extrabold text-rose-400 uppercase tracking-[0.2em] mb-1">Delivered</p>
                        <h3 class="text-4xl font-black text-slate-900 tracking-tighter group-hover:text-rose-600 transition-colors">{{ number_format($soldCars) }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-10">
            <!-- Chart Section -->
            <div class="lg:col-span-2 bg-white rounded-[2.5rem] p-8 shadow-sm border border-slate-200/60">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h3 class="text-xl font-black text-slate-900 tracking-tight">Revenue Activity</h3>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Euros over time</p>
                    </div>
                </div>
                <div class="h-[350px] w-full" wire:ignore>
                    <canvas id="salesChart"></canvas>
                </div>
            </div>

            <!-- Quick Action Center -->
            <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-slate-200/60">
                <h3 class="text-xl font-black text-slate-900 tracking-tight mb-8">Quick Actions</h3>
                <div class="grid grid-cols-1 gap-4">
                    <a href="{{ route('admin.cars.create') }}" class="group flex items-center p-4 bg-slate-50 rounded-2xl border border-slate-100 transition-all hover:bg-blue-600 hover:border-blue-500 hover:shadow-xl hover:shadow-blue-500/20">
                        <div class="w-12 h-12 bg-white rounded-xl shadow-sm flex items-center justify-center text-blue-600 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-black text-slate-900 group-hover:text-white transition-colors">List New Car</p>
                            <p class="text-xs font-bold text-slate-400 group-hover:text-blue-100 transition-colors">Start the wizard</p>
                        </div>
                    </a>

                    <a href="{{ route('admin.brands.index') }}" class="group flex items-center p-4 bg-slate-50 rounded-2xl border border-slate-100 transition-all hover:bg-violet-600 hover:border-violet-500 hover:shadow-xl hover:shadow-violet-500/20">
                        <div class="w-12 h-12 bg-white rounded-xl shadow-sm flex items-center justify-center text-violet-600 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-black text-slate-900 group-hover:text-white transition-colors">Manage Brands</p>
                            <p class="text-xs font-bold text-slate-400 group-hover:text-violet-100 transition-colors">{{ $totalBrands }} Active partners</p>
                        </div>
                    </a>

                    <a href="{{ route('admin.users.index') }}" class="group flex items-center p-4 bg-slate-50 rounded-2xl border border-slate-100 transition-all hover:bg-slate-900 hover:border-slate-800 hover:shadow-xl hover:shadow-slate-900/20">
                        <div class="w-12 h-12 bg-white rounded-xl shadow-sm flex items-center justify-center text-slate-900 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-black text-slate-900 group-hover:text-white transition-colors">System Users</p>
                            <p class="text-xs font-bold text-slate-400 group-hover:text-slate-300 transition-colors">{{ $totalUsers }} Members</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Recent Inventory Table -->
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-200/60 overflow-hidden mb-8 animate-fade-in-up">
            <div class="px-8 py-7 border-b border-slate-100 flex items-center justify-between bg-white">
                <div>
                    <h3 class="text-2xl font-black text-slate-900 tracking-tight">Recently Added</h3>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Latest arrivals in stock</p>
                </div>
                <a href="{{ route('admin.cars.index') }}"
                    class="group flex items-center gap-2 px-6 py-3 bg-blue-50 text-blue-700 rounded-2xl text-sm font-black transition-all hover:bg-blue-600 hover:text-white hover:shadow-lg hover:shadow-blue-500/25">
                    View Fleet
                    <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="bg-slate-50/50">
                            <th class="px-8 py-5 text-left text-[10px] font-black text-slate-400 uppercase tracking-widest">Vehicle details</th>
                            <th class="px-8 py-5 text-left text-[10px] font-black text-slate-400 uppercase tracking-widest">Classification</th>
                            <th class="px-8 py-5 text-left text-[10px] font-black text-slate-400 uppercase tracking-widest">Market Price</th>
                            <th class="px-8 py-5 text-left text-[10px] font-black text-slate-400 uppercase tracking-widest">Status</th>
                            <th class="px-8 py-5 text-right text-[10px] font-black text-slate-400 uppercase tracking-widest">Timeline</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($recentCars as $car)
                            <tr class="hover:bg-blue-50/30 transition-all duration-300 group">
                                <td class="px-8 py-6">
                                    <div class="flex items-center">
                                        <div class="h-12 w-20 flex-shrink-0 rounded-2xl bg-white shadow-sm border border-slate-200 p-1 group-hover:scale-110 transition-transform duration-500 overflow-hidden relative">
                                            @php
                                                $displayImage = $car->images->where('is_primary', true)->first() ?? $car->images->first();
                                            @endphp
                                            @if($displayImage)
                                                <img src="{{ Storage::disk('public')->url($displayImage->image_path) }}" class="w-full h-full object-cover rounded-xl shadow-sm">
                                            @else
                                                <div class="w-full h-full bg-slate-50 rounded-xl flex items-center justify-center text-slate-300">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-5">
                                            <div class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">
                                                {{ $car->registration_number }}
                                            </div>
                                            <div class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">
                                                {{ $car->chassis_number }}
                                            </div>
                                            <div class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-1 flex items-center gap-1.5">
                                                <div class="w-3 h-3 rounded-full border border-slate-200 shadow-sm" style="background-color: {{ strtolower(str_replace(' ', '', $car->color)) }}"></div>
                                                {{ $car->color }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="text-xs font-black text-slate-900 tracking-tight">{{ $car->brand->name ?? 'Unknown Brand' }}</div>
                                    <div class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">Model: {{ $car->year_of_manufacture }}</div>
                                    <div class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">{{ $car->type->name ?? $car->model->name ?? 'Standard' }}</div>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="text-base font-black text-slate-900 tracking-tighter">
                                        €{{ number_format($car->selling_price, 0) }}
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    @php
                                        $statusConfig = [
                                            'available' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
                                            'sold' => 'bg-slate-900 text-white border-slate-800',
                                            'reserved' => 'bg-amber-50 text-amber-600 border-amber-100',
                                            'in_service' => 'bg-blue-50 text-blue-600 border-blue-100'
                                        ];
                                        $currentStatusClasses = $statusConfig[$car->status] ?? 'bg-slate-50 text-slate-600 border-slate-100';
                                    @endphp
                                    <span @class([
                                        'inline-flex items-center px-4 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest border shadow-sm transition-all duration-300',
                                        $currentStatusClasses
                                    ])>
                                        <span class="w-1.5 h-1.5 rounded-full mr-2 {{ $car->status === 'sold' ? 'bg-white' : 'bg-current shadow-[0_0_8px_currentColor]' }}"></span>
                                        {{ str_replace('_', ' ', $car->status) }}
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <div class="text-xs font-black text-slate-900">{{ $car->created_at->format('M d') }}</div>
                                    <div class="text-[10px] font-bold text-slate-400 uppercase group-hover:text-blue-500 transition-colors">{{ $car->created_at->diffForHumans() }}</div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    <!-- Chart.js and Dashboard Scripts -->
    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('livewire:initialized', () => {
            const ctx = document.getElementById('salesChart');
            
            let salesChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($chartLabels),
                    datasets: [{
                        label: 'Revenue',
                        data: @json($chartValues),
                        borderColor: '#2563eb',
                        borderWidth: 4,
                        backgroundColor: 'rgba(37, 99, 235, 0.05)',
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#2563eb',
                        pointBorderWidth: 3,
                        pointRadius: 6,
                        pointHoverRadius: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: 'rgba(0,0,0,0.03)' },
                            ticks: { font: { weight: 'bold', size: 10 }, color: '#94a3b8' }
                        },
                        x: {
                            grid: { display: false },
                            ticks: { font: { weight: 'bold', size: 10 }, color: '#94a3b8' }
                        }
                    }
                }
            });

            @this.on('chartUpdated', (data) => {
                salesChart.data.labels = data.labels;
                salesChart.data.datasets[0].data = data.values;
                salesChart.update();
            });
        });
    </script>
    @endpush

    <style>
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up { animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        .animate-fade-in { animation: fadeIn 0.8s ease-out; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    </style>
</div>