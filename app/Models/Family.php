<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    protected $primaryKey = 'fml_id';
protected $table = 'families';
public $timestamps = false;
protected $guarded =[];

}
