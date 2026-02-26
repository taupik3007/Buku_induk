<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
     protected $table = 'students';
    protected $primaryKey = 'std_id';
    protected $guarded =[];
    // public $timestamps = false;
    const CREATED_AT = 'std_created_at';
    const UPDATED_AT = 'std_updated_at';
    const DELETED_AT = 'std_deleted_at';
     public function user()
    {
        return $this->belongsTo(
            User::class,
            'std_usr_id', // FK di students
            'usr_id'      // PK di users
        );
    }
}
