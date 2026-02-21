<div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <!-- Dashboard Header -->
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold tracking-tight text-slate-900 leading-tight">Dashboard Overview</h1>
                <p class="mt-2 text-sm text-slate-500">Welcome back, <?php echo e(Auth::user()->name); ?>. Here's what's happening
                    today.</p>
            </div>
            <div class="hidden sm:block">
                <span
                    class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-slate-700 shadow-sm ring-1 ring-inset ring-slate-300">
                    <?php echo e(now()->format('F j, Y')); ?>

                </span>
            </div>
        </div>

        <!-- Metric Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

            <!-- Total Sales Card -->
            <div
                class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-600 to-indigo-700 p-6 shadow-xl shadow-blue-900/10 group hover:-translate-y-1 transition-all duration-300">
                <div class="absolute top-0 right-0 -mt-4 -mr-4 h-24 w-24 rounded-full bg-white/10 blur-xl"></div>
                <div class="absolute bottom-0 left-0 -mb-4 -ml-4 h-24 w-24 rounded-full bg-blue-500/20 blur-xl"></div>

                <div class="relative">
                    <div class="flex items-center justify-between">
                        <div class="rounded-lg bg-white/20 p-2 text-white backdrop-blur-sm">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span
                            class="flex items-center text-xs font-semibold text-emerald-300 bg-emerald-500/20 px-2 py-0.5 rounded-full backdrop-blur-md border border-white/10">
                            +12.5%
                            <svg class="ml-1 h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 10l7-7m0 0l7 7m-7-7v18" />
                            </svg>
                        </span>
                    </div>
                    <dl class="mt-4">
                        <dt class="text-sm font-medium text-blue-100 truncate">Total Sales</dt>
                        <dd class="mt-1 text-3xl font-bold tracking-tight text-white">
                            €<?php echo e(number_format($totalSales, 0)); ?></dd>
                    </dl>
                </div>
            </div>

            <!-- Total Cars Card -->
            <div
                class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-violet-600 to-purple-700 p-6 shadow-xl shadow-violet-900/10 group hover:-translate-y-1 transition-all duration-300">
                <div class="absolute top-0 right-0 -mt-4 -mr-4 h-24 w-24 rounded-full bg-white/10 blur-xl"></div>

                <div class="relative">
                    <div class="flex items-center justify-between">
                        <div class="rounded-lg bg-white/20 p-2 text-white backdrop-blur-sm">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <span
                            class="flex items-center text-xs font-semibold text-white/80 bg-white/10 px-2 py-0.5 rounded-full backdrop-blur-md border border-white/10">Active</span>
                    </div>
                    <dl class="mt-4">
                        <dt class="text-sm font-medium text-violet-100 truncate">Total Inventory</dt>
                        <dd class="mt-1 text-3xl font-bold tracking-tight text-white"><?php echo e(number_format($totalCars)); ?>

                        </dd>
                    </dl>
                </div>
            </div>

            <!-- Total Brands Card -->
            <div
                class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-sky-500 to-cyan-600 p-6 shadow-xl shadow-sky-900/10 group hover:-translate-y-1 transition-all duration-300">
                <div class="absolute top-0 right-0 -mt-4 -mr-4 h-24 w-24 rounded-full bg-white/10 blur-xl"></div>

                <div class="relative">
                    <div class="flex items-center justify-between">
                        <div class="rounded-lg bg-white/20 p-2 text-white backdrop-blur-sm">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                        </div>
                    </div>
                    <dl class="mt-4">
                        <dt class="text-sm font-medium text-sky-100 truncate">Parter Brands</dt>
                        <dd class="mt-1 text-3xl font-bold tracking-tight text-white"><?php echo e(number_format($totalBrands)); ?>

                        </dd>
                    </dl>
                </div>
            </div>

            <!-- Total Users Card -->
            <div
                class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-slate-700 to-slate-800 p-6 shadow-xl shadow-slate-900/10 group hover:-translate-y-1 transition-all duration-300">
                <div class="absolute top-0 right-0 -mt-4 -mr-4 h-24 w-24 rounded-full bg-white/5 blur-xl"></div>

                <div class="relative">
                    <div class="flex items-center justify-between">
                        <div class="rounded-lg bg-white/10 p-2 text-white backdrop-blur-sm">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <span
                            class="flex items-center text-xs font-semibold text-emerald-300 bg-emerald-500/10 px-2 py-0.5 rounded-full border border-emerald-500/20">
                            +4 New
                        </span>
                    </div>
                    <dl class="mt-4">
                        <dt class="text-sm font-medium text-slate-300 truncate">Total Users</dt>
                        <dd class="mt-1 text-3xl font-bold tracking-tight text-white"><?php echo e(number_format($totalUsers)); ?>

                        </dd>
                    </dl>
                </div>
            </div>
        </div>

        <!-- Recent Cars Section -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200/60 overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                <h3 class="text-lg font-bold text-slate-800">Recently Added Inventory</h3>
                <a href="<?php echo e(route('admin.cars.index')); ?>"
                    class="text-sm font-medium text-blue-600 hover:text-blue-700 flex items-center gap-1 transition-colors">
                    View All
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-100">
                    <thead class="bg-slate-50/50">
                        <tr>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Vehicle Details</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Classification</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Price</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Status</th>
                            <th
                                class="px-6 py-4 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Date Added</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-100">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $recentCars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $car): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="hover:bg-slate-50/80 transition-colors group">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div
                                            class="h-10 w-10 flex-shrink-0 rounded-lg bg-slate-100 flex items-center justify-center text-slate-500 font-bold text-xs ring-1 ring-slate-200">
                                            <?php echo e(substr($car->make->name ?? $car->brand->name ?? '?', 0, 1)); ?>

                                        </div>
                                        <div class="ml-4">
                                            <div
                                                class="text-sm font-semibold text-slate-900 group-hover:text-blue-600 transition-colors">
                                                <?php echo e($car->registration_number); ?></div>
                                            <div class="text-xs text-slate-500 font-mono"><?php echo e($car->chassis_number); ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-slate-900"><?php echo e($car->brand->name ?? 'N/A'); ?></div>
                                    <div class="text-xs text-slate-500"><?php echo e($car->model->name ?? 'N/A'); ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-bold text-slate-900 font-mono">
                                        €<?php echo e(number_format($car->selling_price, 2)); ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2.5 py-1 inline-flex text-xs font-semibold rounded-full border 
                                            <?php echo e($car->status === 'available' ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : ''); ?>

                                            <?php echo e($car->status === 'sold' ? 'bg-slate-50 text-slate-600 border-slate-200' : ''); ?>

                                            <?php echo e($car->status === 'reserved' ? 'bg-amber-50 text-amber-700 border-amber-200' : ''); ?>

                                            <?php echo e($car->status === 'in_service' ? 'bg-blue-50 text-blue-700 border-blue-200' : ''); ?>">
                                        <?php echo e(ucfirst(str_replace('_', ' ', $car->status))); ?>

                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-slate-500">
                                    <?php echo e($car->created_at->diffForHumans()); ?>

                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div><?php /**PATH /var/www/html/resources/views/livewire/admin/dashboard.blade.php ENDPATH**/ ?>