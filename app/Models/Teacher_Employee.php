<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
class Teacher_Employee extends Model
{
    use SoftDeletes ;
    protected $table = 'teacher_employees';
    protected $primaryKey = 'tce_id';
    protected $guarded = [];

    const CREATED_AT = 'tce_created_at';
    const UPDATED_AT = 'tce_updated_at';
    const DELETED_AT = 'tce_deleted_at';
}
