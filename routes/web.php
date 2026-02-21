<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/cars/{car}', App\Livewire\CarDetails::class)->name('cars.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/admin', App\Livewire\Admin\Dashboard::class)->name('dashboard');
        Route::redirect('/dashboard', '/admin');
        Route::get('/admin/users', App\Livewire\Admin\UserManagement::class)->name('admin.users.index');
        Route::get('/admin/roles', App\Livewire\Admin\RoleManagement::class)->name('admin.roles.index');
        Route::get('/admin/brands', App\Livewire\Admin\BrandManager::class)->name('admin.brands.index');
        Route::get('/admin/car-types', App\Livewire\Admin\CarTypeManager::class)->name('admin.car-types.index');
        Route::get('/admin/cars/create-wizard', App\Livewire\Admin\CarWizard::class)->name('admin.cars.wizard');
        Route::get('/admin/cars', App\Livewire\Admin\CarManager::class)->name('admin.cars.index');
        Route::get('/admin/cars/create', App\Livewire\Admin\CarForm::class)->name('admin.cars.create');
        Route::get('/admin/cars/{car}/edit', App\Livewire\Admin\CarWizard::class)->name('admin.cars.edit');
    });
});

require __DIR__ . '/auth.php';
