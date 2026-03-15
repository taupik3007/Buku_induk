<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProspectiveStudentRequirement extends Model
{
    use  SoftDeletes ;
    protected $table = 'prospective_student_requirements';
    protected $primaryKey = 'psr_id';
    protected $guarded = [];

    const CREATED_AT = 'psr_created_at';
    const UPDATED_AT = 'psr_updated_at';
    const DELETED_AT = 'psr_deleted_at';
}
