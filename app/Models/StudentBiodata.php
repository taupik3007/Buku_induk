<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentBiodata extends Model
{
    protected $table = 'student_biodatas';
    protected $guarded =[];
    protected $primaryKey = 'stb_id';
    const CREATED_AT = 'stb_created_at';
    const UPDATED_AT = 'stb_updated_at';
    const DELETED_AT = 'stb_deleted_at';
    
    public function religion()
    {
        return $this->hasOne(Religion::class, 'rlg_id', 'stb_religion_id');
    }
    
}
