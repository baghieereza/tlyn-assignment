<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'احمد',
            'email' => 'test@gmail.com',
            'password' => '123123',
            'gold_balance' => 0,
            'cash_balance' => 100000000,
        ]);

        User::create([
            'name' => 'رضا',
            'email' => 'test2@gmail.com',
            'password' => '123123',
            'gold_balance' => 0,
            'cash_balance' => 100000000,
        ]);

        User::create([
            'name' => 'اکبر',
            'email' => 'test4@gmail.com',
            'password' => '123123',
            'gold_balance' => 8.517,
            'cash_balance' => 0,
        ]);
    }
}
