<?php

namespace Database\Seeders;

use App\Facades\User as UserFacade;
use App\Models\Admin;
use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserFacade::firstOrCreate([
            'email' => 'testuser@example.com'
        ],[
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'phone' => '234' . fake()->unique()->numberBetween(700000000, 799999999),
            'model' => Customer::class,
            'password' => Hash::make('$2C00l#@theM0m3nt!'),
            'email_verified_at' => now(),
        ]);

        UserFacade::firstOrCreate([
            'email' => 'testadmin@innoscripta.com'
        ],[
            'name' => 'Test Admin',
            'email' => 'testadmin@innoscripta.com',
            'phone' => '234' . fake()->unique()->numberBetween(700000000, 799999999),
            'model' => Admin::class,
            'password' => Hash::make('$2C00l#@theM0m3nt!'),
            'email_verified_at' => now(),
        ]);
    }
}
