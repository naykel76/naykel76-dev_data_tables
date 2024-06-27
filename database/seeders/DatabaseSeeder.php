<?php

namespace Database\Seeders;

use App\Models\Transaction;
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
        Transaction::factory(150)->fastFood()->create();
        Transaction::factory(12)->wages()->create();
        Transaction::factory(2)->utilities()->create();
        Transaction::factory(10)->groceries()->create();
        Transaction::factory(10)->petrol()->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
