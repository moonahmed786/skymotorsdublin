<div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-2">
                <!-- Image Gallery -->
                <div class="p-6 bg-gray-100 dark:bg-gray-700">
                    <div class="mb-4 aspect-[4/3] rounded-lg overflow-hidden relative group">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($car->images->count() > 0): ?>
                            <img src="<?php echo e(Storage::url($car->images->first()->image_path)); ?>"
                                class="w-full h-full object-cover" id="mainImage">
                        <?php else: ?>
                            <div class="flex items-center justify-center h-full bg-gray-300 dark:bg-gray-600 text-gray-400">
                                <span class="text-lg">No Image Available</span>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($car->images->count() > 1): ?>
                        <div class="grid grid-cols-4 gap-2">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $car->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="cursor-pointer rounded-md overflow-hidden aspect-square border-2 border-transparent hover:border-blue-500 transition"
                                    onclick="document.getElementById('mainImage').src = '<?php echo e(Storage::url($image->image_path)); ?>'">
                                    <img src="<?php echo e(Storage::url($image->image_path)); ?>" class="w-full h-full object-cover">
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <!-- Car Details -->
                <div class="p-8 lg:p-12">
                    <div class="mb-6">
                        <div class="flex items-center gap-2 mb-2">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($car->brand && $car->brand->logo_path): ?>
                                <img src="<?php echo e(Storage::url($car->brand->logo_path)); ?>" class="h-8 w-8 object-contain">
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <h2 class="text-sm font-semibold text-blue-600 uppercase tracking-wide">
                                <?php echo e($car->brand->name ?? $car->make->name ?? 'Unknown Make'); ?>

                            </h2>
                        </div>
                        <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mb-2">
                            <?php echo e($car->brand->name ?? $car->make->name); ?> <?php echo e($car->type->name ?? $car->model->name); ?>

                        </h1>
                        <p class="text-lg text-gray-600 dark:text-gray-300"><?php echo e($car->year_of_manufacture); ?> •
                            <?php echo e(number_format($car->mileage)); ?> km</p>
                    </div>

                    <div class="flex items-center justify-between mb-8 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Price</p>
                            <p class="text-3xl font-bold text-secondary-600 dark:text-secondary-400">
                                €<?php echo e(number_format($car->selling_price)); ?></p>
                        </div>
                        <div>
                            <span
                                class="px-3 py-1 text-sm font-semibold rounded-full 
                                <?php echo e($car->status === 'available' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'); ?>">
                                <?php echo e(ucfirst($car->status)); ?>

                            </span>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-y-4 gap-x-8 mb-8">
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Engine Size</dt>
                            <dd class="text-base font-semibold text-gray-900 dark:text-white"><?php echo e($car->engine_size); ?>

                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Fuel Type</dt>
                            <dd class="text-base font-semibold text-gray-900 dark:text-white">
                                <?php echo e(ucfirst($car->fuel_type)); ?></dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Transmission</dt>
                            <dd class="text-base font-semibold text-gray-900 dark:text-white">
                                <?php echo e(ucfirst($car->transmission)); ?></dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Body Type</dt>
                            <dd class="text-base font-semibold text-gray-900 dark:text-white">
                                <?php echo e($car->body_type ?? 'N/A'); ?></dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Color</dt>
                            <dd class="text-base font-semibold text-gray-900 dark:text-white"><?php echo e(ucfirst($car->color)); ?>

                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">NCT Expiry</dt>
                            <dd class="text-base font-semibold text-gray-900 dark:text-white">
                                <?php echo e($car->nct_expiry_date ? $car->nct_expiry_date->format('d M Y') : 'N/A'); ?></dd>
                        </div>
                    </div>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($car->description): ?>
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Description</h3>
                            <div class="prose dark:prose-invert text-gray-600 dark:text-gray-300">
                                <?php echo nl2br(e($car->description)); ?>

                            </div>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($car->features && count($car->features) > 0): ?>
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Features</h3>
                            <div class="flex flex-wrap gap-2">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $car->features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <span
                                        class="px-3 py-1 bg-blue-50 dark:bg-blue-900 text-blue-700 dark:text-blue-300 rounded-full text-sm font-medium">
                                        <?php echo e($feature); ?>

                                    </span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

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
</div><?php /**PATH /var/www/html/resources/views/livewire/car-details.blade.php ENDPATH**/ ?>