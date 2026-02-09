<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Academic_Year extends Model
{
    use HasFactory, SoftDeletes ;
    protected $table = 'academic_years';
    protected $primaryKey = 'acy_id';
    protected $guarded = [];

    const CREATED_AT = 'acy_created_at';
    const UPDATED_AT = 'acy_updated_at';
    const DELETED_AT = 'acy_deleted_at';

    public function getAcademicYearAttribute()
    {
        return $this->acy_year . '/' . ($this->acy_year + 1);
    }

}
