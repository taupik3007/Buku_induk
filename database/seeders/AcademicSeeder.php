<?php

namespace Database\Seeders;

use App\Models\Academic_Year;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AcademicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('academic_years')->insert([
            [
                'acy_year' => 2025,
                'acy_status' => 1,
            ]
        ]);
    }
}
