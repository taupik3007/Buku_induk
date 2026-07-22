<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeacherSubmission extends Model
{
    use HasFactory, SoftDeletes ;
    protected $table = 'teacher_submissions';
    protected $primaryKey = 'tsb_id';
    protected $guarded = [];

    const CREATED_AT = 'tsb_created_at';
    const UPDATED_AT = 'tsb_updated_at';
    const DELETED_AT = 'tsb_deleted_at';

    public function requirement()
    {
        return $this->belongsTo(
            TeacherRequirement::class,
            'tsb_requirement_id',
            'tcq_id'
        );
    }

    public function teacher()
    {
        return $this->belongsTo(
            Teacher::class,
            'tsb_teacher_id',
            'tcr_id'
        );
    }
}
