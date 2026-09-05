<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ScheduleSlot extends Model
{
    use SoftDeletes;

    protected $table = 'schedule_slots';

    protected $primaryKey = 'slt_id';

    protected $fillable = [
        'slt_day',
        'slt_number',
        'slt_start_time',
        'slt_end_time',
        'slt_type',
        'slt_created_by',
        'slt_updated_by',
        'slt_deleted_by',
        'slt_sys_note',
    ];

    const CREATED_AT = 'slt_created_at';
    const UPDATED_AT = 'slt_updated_at';
    const DELETED_AT = 'slt_deleted_at';

    public function schedules()
    {
        return $this->hasMany(
            Schedule::class,
            'sch_slot_id',
            'slt_id'
        );
    }

    public function createdBy()
    {
        return $this->belongsTo(
            User::class,
            'slt_created_by',
            'usr_id'
        );
    }

    public function updatedBy()
    {
        return $this->belongsTo(
            User::class,
            'slt_updated_by',
            'usr_id'
        );
    }

    public function deletedBy()
    {
        return $this->belongsTo(
            User::class,
            'slt_deleted_by',
            'usr_id'
        );
    }
}