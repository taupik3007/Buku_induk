<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Teacher_Employee;
use App\Models\Teacher;
use App\Models\Teacher_BIo;
use App\Models\Address;
use App\Models\Teacher_Partner;

use Carbon\Carbon;

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
        $now = Carbon::now();
        
        $teacher_employee = Teacher_Employee::insert([
            'tce_teacher_id'      =>  $teacher_data->tcr_id,
            'tce_tmt'             => 20150801,
            'tce_no_sk'           => 'SK/001/GTK/2015',
            'tce_duration'        => '1 Tahun',
            'tce_length_service'  => '10 Tahun',
            'tce_status'          => 'PNS',
            'tce_position'        => 'Guru Mata Pelajaran',
            'tce_inpasign'        => 'III/b',
            'tce_additional_task' => 'Wali Kelas X RPL 1',
            'tce_created_at'      => $now,
            'tce_updated_at'      => $now,
            'tce_created_by'      => 1,
            'tce_updated_by'      => null,
            'tce_deleted_by'      => null,
            'tce_deleted_at'      => null,
            'tce_sys_note'        => null,
        ]);

        $teacherBio = Teacher_Bio::create([
            'tcb_teacher_id'  => $teacher_data->tcr_id,
                'tcb_birth_place' => 'Jakarta',
                'tcb_birth_date'  => '1985-03-15',
                'tcb_religion' => 'islam',
                'tcb_mary_status' => 1, // 1 = Menikah
                'tcb_gender'      => 1, // 1 = Laki-laki
                'tcb_telp'        => 6281234567890,
                'tcb_created_at'  => $now,
                'tcb_updated_at'  => $now,
                'tcb_created_by'  => 1,
                'tcb_updated_by'  => null,
                'tcb_deleted_by'  => null,
                'tcb_deleted_at'  => null,
                'tcb_sys_note'    => null,
        ]);

         $teacherAddress = Address::insert([
            'adr_user_id'        => $teacher->usr_id,
            'adr_detail'         => 'Jl. Merdeka No. 10 RT 001 RW 002',
            'adr_village'        => 'Menteng',
            'adr_village_value'  => '3173010001',
            'adr_district'       => 'Menteng',
            'adr_district_value' => '317301',
            'adr_regency'        => 'Kota Jakarta Pusat',
            'adr_regency_value'  => '3173',
            'adr_province'       => 'DKI Jakarta',
            'adr_province_value' => '31',
            'adr_postal_code'    => 10310,
            'adr_distance'       => 5,
            'adr_created_at'     => $now,
            'adr_updated_at'     => $now,
            'adr_created_by'     => 1,
            'adr_updated_by'     => null,
            'adr_deleted_by'     => null,
            'adr_deleted_at'     => null,
            'adr_sys_note'       => null,
        ]);

        $teacehrPartner= Teacher_Partner::insert([
            'tcp_teacher_id' => $teacher_data->tcr_id,
            'tcp_name'       => 'Siti Rahayu',
            'tcp_nik'        => 3171234567890001,
            'tcp_work'       => 'Pegawai Swasta',
            'tcp_nip'        => null,
            'tcp_created_at' => $now,
            'tcp_updated_at' => $now,
            'tcp_created_by' => 1,
            'tcp_updated_by' => null,
            'tcp_deleted_by' => null,
            'tcp_deleted_at' => null,
            'tcp_sys_note'   => null,
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
