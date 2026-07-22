<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeacherRequirement extends Model
{
    use HasFactory, SoftDeletes ;
    protected $table = 'teacher_requirements';
    protected $primaryKey = 'tcq_id';
    protected $guarded = [];

    const CREATED_AT = 'tcq_created_at';
    const UPDATED_AT = 'tcq_updated_at';
    const DELETED_AT = 'tcq_deleted_at';
}
