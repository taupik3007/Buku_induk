<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    // use  SoftDeletes ;
    protected $table = 'addresses';
    protected $primaryKey = 'adr_id';
    protected $guarded = [];

    const CREATED_AT = 'adr_created_at';
    const UPDATED_AT = 'adr_updated_at';
    const DELETED_AT = 'adr_deleted_at';
}
