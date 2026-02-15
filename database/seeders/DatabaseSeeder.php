<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Religion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        Religion::insert([
            ['rlg_name' => 'Islam'],
            ['rlg_name' => 'Kristen'],
            ['rlg_name' => 'Katolik'],
            ['rlg_name' => 'Hindu'],
            ['rlg_name' => 'Buddha'],
            ['rlg_name' => 'Konghucu'],
        ]);

        
        
        $this->call([RoleSeeder::class]);
    }
}
