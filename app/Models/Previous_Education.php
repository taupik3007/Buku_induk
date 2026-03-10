<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Previous_Education extends Model
{
    use  SoftDeletes ;
    protected $table = 'previous_education';
    protected $primaryKey = 'prv_id';
    protected $guarded = [];

    const CREATED_AT = 'prv_created_at';
    const UPDATED_AT = 'prv_updated_at';
    const DELETED_AT = 'prv_deleted_at';
}
