<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Teacher_Employee;
use App\Models\Teacher;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teacher = User::create([
            'usr_name' => 'guru 1',
            'email' => 'guru1@gmail.com',
            'password' => bcrypt(123456789),
        ]);
        $teacher->assignRole('teacher');

        $teacher_data = Teacher::create([
            'tcr_gtk' => '16.17.01.03',
            'tcr_user_id' => $teacher->usr_id,
        ]);
        
        $teacher_employee = Teacher_Employee::create([
            'tce_teacher_id'=> $teacher_data->tcr_id,
            'tce_position' => "Guru Produktif"
        ]);
        $teacher2 = User::create([
            'usr_name' => 'guru 2',
            'email' => 'guru2@gmail.com',
            'password' => bcrypt(123456789),
        ]);
        $teacher2->assignRole('teacher');
        $teacher_data2 = Teacher::create([
            'tcr_gtk' => '16.17.01.04',
            'tcr_user_id' => $teacher2->usr_id,
        ]);
        
        $teacher_employee2 = Teacher_Employee::create([
            'tce_teacher_id'=> $teacher_data2->tcr_id,
            'tce_position' => "Guru Produktif"
        ]);
        $administrasi = User::create([
            'usr_name' => 'adm 2',
            'email' => 'adm2@gmail.com',
            'password' => bcrypt(123456789),
        ]);
        $administrasi->assignRole('administration');
    }
}
