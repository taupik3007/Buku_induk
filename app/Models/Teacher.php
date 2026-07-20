<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    use SoftDeletes ;
    protected $table = 'teachers';
    protected $primaryKey = 'tcr_id';
    protected $guarded = [];

    const CREATED_AT = 'tcr_created_at';
    const UPDATED_AT = 'tcr_updated_at';
    const DELETED_AT = 'tcr_deleted_at';

    public function teacherEmployee()
{
    return $this->hasOne(Teacher_Employee::class, 'tce_teacher_id', 'tcr_id');
}
public function teacherBio()
{
    return $this->hasOne(Teacher_Bio::class, 'tcb_teacher_id', 'tcr_id');
}
public function user()
{
    return $this->hasOne(User::class, 'usr_id','tcr_user_id');
}
public function teacherPartner()
{
    return $this->hasOne(Teacher_Partner::class, 'tcp_teacher_id','tcr_id');
}
public function teacherEducation()
{
    return $this->hasMany(TeacherEducation::class, 'tce_teacher_id','tcr_id');
}
public function certification()
{
    return $this->hasOne(Certification::class, 'cft_teacher_id','tcr_id');
}
public function teachHistories()
{
    return $this->hasMany(Teach_History::class,'tcs_teacher_id','tcr_id');
}
public function teacherAddress()
{
    return $this->hasOne(Teacher_Address::class, 'tca_teacher_id', 'tcr_id');
}
}
