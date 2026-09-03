<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubjectTeacher extends Model
{
    use SoftDeletes;

    protected $table = 'subject_teachers';

    protected $primaryKey = 'subt_id';

    protected $fillable = [
        'subt_subject_id',
        'subt_class_id',
        'subt_teacher_id',
        'subt_academic_year_id',
        'subt_total_hours',
        'subt_created_by',
        'subt_updated_by',
        'subt_deleted_by',
        'subt_sys_note',
    ];

    const CREATED_AT = 'subt_created_at';
    const UPDATED_AT = 'subt_updated_at';
    const DELETED_AT = 'subt_deleted_at';

    public function subject()
    {
        return $this->belongsTo(
            Subject::class,
            'subt_subject_id',
            'sbj_id'
        );
    }

    public function class()
    {
        return $this->belongsTo(
            Classes::class,
            'subt_class_id',
            'cls_id'
        );
    }

    public function teacher()
    {
        return $this->belongsTo(
            Teacher::class,
            'subt_teacher_id',
            'tcr_id'
        );
    }

    public function academicYear()
    {
        return $this->belongsTo(
            Academic_Year::class,
            'subt_academic_year_id',
            'acy_id'
        );
    }

    public function createdBy()
    {
        return $this->belongsTo(
            User::class,
            'subt_created_by',
            'usr_id'
        );
    }

    public function updatedBy()
    {
        return $this->belongsTo(
            User::class,
            'subt_updated_by',
            'usr_id'
        );
    }

    public function deletedBy()
    {
        return $this->belongsTo(
            User::class,
            'subt_deleted_by',
            'usr_id'
        );
    }
}