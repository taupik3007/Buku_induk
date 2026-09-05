<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use SoftDeletes;

    protected $table = 'schedules';

    protected $primaryKey = 'sch_id';

    protected $fillable = [
        'sch_subject_teacher_id',
        'sch_slot_id',
        'sch_created_by',
        'sch_updated_by',
        'sch_deleted_by',
        'sch_sys_note',
    ];

    const CREATED_AT = 'sch_created_at';
    const UPDATED_AT = 'sch_updated_at';
    const DELETED_AT = 'sch_deleted_at';

    public function subjectTeacher()
    {
        return $this->belongsTo(
            SubjectTeacher::class,
            'sch_subject_teacher_id',
            'subt_id'
        );
    }

    public function slot()
    {
        return $this->belongsTo(
            ScheduleSlot::class,
            'sch_slot_id',
            'slt_id'
        );
    }

    public function createdBy()
    {
        return $this->belongsTo(
            User::class,
            'sch_created_by',
            'usr_id'
        );
    }

    public function updatedBy()
    {
        return $this->belongsTo(
            User::class,
            'sch_updated_by',
            'usr_id'
        );
    }

    public function deletedBy()
    {
        return $this->belongsTo(
            User::class,
            'sch_deleted_by',
            'usr_id'
        );
    }
}