<?php

namespace Database\Seeders;

use App\Models\ScheduleSlot;
use Illuminate\Database\Seeder;

class ScheduleSlotSeeder extends Seeder
{
    public function run(): void
    {
        $days = [
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
        ];

        $slots = [
            [
                'slt_number' => 1,
                'slt_start_time' => '07:00',
                'slt_end_time' => '07:40',
                'slt_type' => 'lesson',
            ],
            [
                'slt_number' => 2,
                'slt_start_time' => '07:40',
                'slt_end_time' => '08:20',
                'slt_type' => 'lesson',
            ],
            [
                'slt_number' => 3,
                'slt_start_time' => '08:20',
                'slt_end_time' => '09:00',
                'slt_type' => 'lesson',
            ],

            // Istirahat 1
            [
                'slt_number' => null,
                'slt_start_time' => '09:00',
                'slt_end_time' => '09:20',
                'slt_type' => 'break',
            ],

            [
                'slt_number' => 4,
                'slt_start_time' => '09:20',
                'slt_end_time' => '10:00',
                'slt_type' => 'lesson',
            ],
            [
                'slt_number' => 5,
                'slt_start_time' => '10:00',
                'slt_end_time' => '10:40',
                'slt_type' => 'lesson',
            ],
            [
                'slt_number' => 6,
                'slt_start_time' => '10:40',
                'slt_end_time' => '11:20',
                'slt_type' => 'lesson',
            ],
            [
                'slt_number' => 7,
                'slt_start_time' => '11:20',
                'slt_end_time' => '12:00',
                'slt_type' => 'lesson',
            ],

            // Istirahat 2
            [
                'slt_number' => null,
                'slt_start_time' => '12:00',
                'slt_end_time' => '12:40',
                'slt_type' => 'break',
            ],

            [
                'slt_number' => 8,
                'slt_start_time' => '12:40',
                'slt_end_time' => '13:20',
                'slt_type' => 'lesson',
            ],
            [
                'slt_number' => 9,
                'slt_start_time' => '13:20',
                'slt_end_time' => '14:00',
                'slt_type' => 'lesson',
            ],
            [
                'slt_number' => 10,
                'slt_start_time' => '14:00',
                'slt_end_time' => '14:40',
                'slt_type' => 'lesson',
            ],
        ];

        foreach ($days as $day => $dayName) {
            foreach ($slots as $slot) {
                ScheduleSlot::create([
                    'slt_day' => $day,
                    'slt_number' => $slot['slt_number'],
                    'slt_start_time' => $slot['slt_start_time'],
                    'slt_end_time' => $slot['slt_end_time'],
                    'slt_type' => $slot['slt_type'],
                ]);
            }
        }
    }
}