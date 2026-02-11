<?php

namespace Database\Seeders;

use App\Models\User;
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
            'usr_email' => 'guru1@gmail.com',
            'usr_password' => bcrypt(123456789),
        ]);
        $teacher->assignRole('teacher');

        $teacher2 = User::create([
            'usr_name' => 'guru 2',
            'usr_email' => 'guru2@gmail.com',
            'usr_password' => bcrypt(123456789),
        ]);
        $teacher2->assignRole('teacher');

        $administrasi = User::create([
            'usr_name' => 'adm 2',
            'usr_email' => 'adm2@gmail.com',
            'usr_password' => bcrypt(123456789),
        ]);
        $administrasi->assignRole('administration');
    }
}
