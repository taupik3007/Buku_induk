<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use HasFactory, SoftDeletes ;
    protected $table = 'subjects';
    protected $primaryKey = 'sbj_id';
    protected $guarded = [];

    const CREATED_AT = 'sbj_created_at';
    const UPDATED_AT = 'sbj_updated_at';
    const DELETED_AT = 'sbj_deleted_at';

    public function major()
    {
        return $this->belongsTo(Majors::class, 'sbj_major_id');
    }
}
