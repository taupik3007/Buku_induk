<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name'=> 'headOfAdministration']);
        Role::create(['name'=> 'administration']);
        Role::create(['name'=> 'teacher']);
        Role::create(['name'=> 'student']);

        Permission::create(['name'=> 'prospectiveStudent']);
        Permission::create(['name'=> 'prospectiveTeacher']);
        Permission::create(['name'=> 'prospectiveAdministration']);
    }
}
