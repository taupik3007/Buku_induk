<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher_Bio extends Model
{
    use HasFactory, SoftDeletes ;
    protected $table = 'teacher_bios';
    protected $primaryKey = 'tcb_id';
    protected $guarded = [];

    const CREATED_AT = 'tcb_created_at';
    const UPDATED_AT = 'tcb_updated_at';
    const DELETED_AT = 'tcb_deleted_at';

    public function address()
    {
        return $this->hasOne(Teacher_Address::class, 'tca_id');
    }

    public function partner()
    {
        return $this->hasOne(Teacher_Partner::class, 'tcp_id');
    }
    public function religion()
    {
        return $this->hasOne(Religion::class, 'rlg_id','tcb_religion_id');
    }

    public function history()
    {
        return $this->hasMany(Teach_History::class, 'tcs_bio_id');
    }
    public function education()
    {
        return $this->hasMany(TeacherEducation::class, 'tce_bio_id');
    }
    public function teacher()
{
    return $this->belongsTo(Teacher::class, 'tcb_teacher_id', 'tcr_id');
}

}


