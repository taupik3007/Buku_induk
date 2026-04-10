<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Religion;
use App\Models\Ppdb;
use App\Models\Majors;
use App\Models\Academic_Year;
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
        Academic_Year::create([
            'acy_year' => 2025,
            'acy_status' => 0
        ]);
        Ppdb::create([
            'ppd_academic_id'=>1,
            'ppd_start_date' => '2026-03-12',
            'ppd_end_date' => '2026-04-12',
            'ppd_entry_fee'=> 3000000

        ]);
        Majors::insert([
            'mjr_name' => 'Pengembangan Perangkat Lunak dan Gim',
            'mjr_abbr' => 'PPLG'
        ],[
            'mjr_name' => 'Desain Komunikasi Visual',
            'mjr_abbr' => 'DKV'
        ]);


        Religion::insert([
            ['rlg_name' => 'Islam'],
            ['rlg_name' => 'Kristen'],
            ['rlg_name' => 'Katolik'],
            ['rlg_name' => 'Hindu'],
            ['rlg_name' => 'Buddha'],
            ['rlg_name' => 'Konghucu'],
        ]);     
        
        $this->call([RoleSeeder::class]);
          $user =  User::create([
            'usr_name' => 'Test User',
            'email' => 'taupikpathurrohman@gmail.com',
            'password'=> bcrypt('12312311'),
        ]);

        $user->assignRole('administration');
    }
}
