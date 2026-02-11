<?php

namespace Database\Seeders;

use App\Models\Majors;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('majors')->insert([
            [
                'mjr_name' => 'Rekayasa Perangkat Lunak',
                'mjr_abbr' => 'RPL',
            ],
            [
                'mjr_name' => 'Multimedia',
                'mjr_abbr' => 'MM',
            ],
        ]);
    }
}
