<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeacherRequirement extends Model
{
    use HasFactory, SoftDeletes ;
    protected $table = 'teacher_requirements';
    protected $primaryKey = 'tcr_id';
    protected $guarded = [];

    const CREATED_AT = 'tcr_created_at';
    const UPDATED_AT = 'tcr_updated_at';
    const DELETED_AT = 'tcr_deleted_at';
}
