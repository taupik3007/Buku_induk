<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Certification extends Model
{
    use SoftDeletes;
    protected $table = 'certifications';
    protected $primaryKey = 'cft_id';
    protected $guarded = [];

    const CREATED_AT = 'cft_created_at';
    const UPDATED_AT = 'cft_updated_at';
    const DELETED_AT = 'cft_deleted_at';
}
