<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PpdbRequirement extends Model
{
     use  SoftDeletes ;
    protected $table = 'ppdb_requirements';
    protected $primaryKey = 'pdr_id';
    protected $guarded = [];

    const CREATED_AT = 'pdr_created_at';
    const UPDATED_AT = 'pdr_updated_at';
    const DELETED_AT = 'pdr_deleted_at';
}
