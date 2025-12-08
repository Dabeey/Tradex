<?php

use App\Livewire\Customer\ListCustomers;
use App\Livewire\Items\ListInventories;
use App\Livewire\Items\ListItems;
use App\Livewire\Management\ListPaymentMethods;
use App\Livewire\Management\ListUsers;
use App\Livewire\Sales\ListSales;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use App\Livewire\Items\EditItem;
 

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/manage-users',ListUsers::class)->name('users.index');
    Route::get('/manage-items',ListItems::class)->name('items.index');
    Route::get('/edit-item/{record}',EditItem::class)->name('item.update');

    Route::get('/manage-inventories',ListInventories::class)->name('inventories.index');
    Route::get('/manage-sales',ListSales::class)->name('sales.index');
    Route::get('/manage-customers',ListCustomers::class)->name('customers.index');
    Route::get('/manage-payment-method',ListPaymentMethods::class)->name('payment-method.index');

});
