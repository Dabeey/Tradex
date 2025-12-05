<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\Inventory;
use App\Models\PaymentMethod;
use App\Models\Sales;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::firstOrCreate(
        //     ['email' => 'test@example.com'],
        //     [
        //         'name' => 'Test User',
        //         'password' => 'password',
        //         'email_verified_at' => now(),
        //     ]
        // );

        Item::factory(10)->create();
        Inventory::factory(10)->create();
        Customer::factory(10)->create();
        PaymentMethod::factory(3)->create();
        // Sales::factory(10)->create();

    }
}
