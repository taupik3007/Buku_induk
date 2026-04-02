<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class PpdbSubmission extends Model
{
    //  use  SoftDeletes ;

     protected $table = 'ppdb_submissions';
    protected $primaryKey = 'ppsu_id';
    protected $guarded = [];

    const CREATED_AT = 'ppsu_created_at';
    const UPDATED_AT = 'ppsu_updated_at';
    const DELETED_AT = 'ppsu_deleted_at';
}
