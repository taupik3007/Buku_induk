<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ppdb extends Model
{
    use HasFactory, SoftDeletes ;
    protected $table = 'ppdbs';
    protected $primaryKey = 'ppd_id';
    protected $guarded = [];

    const CREATED_AT = 'ppd_created_at';
    const UPDATED_AT = 'ppd_updated_at';
    const DELETED_AT = 'ppd_deleted_at';

    public function academic()
{
    return $this->belongsTo(Academic_Year::class, 'ppd_academic_id', 'acy_id');
}
}
