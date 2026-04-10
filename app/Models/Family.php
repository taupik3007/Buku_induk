<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    protected $primaryKey = 'fml_id';
protected $table = 'families';
public $timestamps = false;
protected $guarded =[];
    public function fatherReligion()
    {
        return $this->hasOne(Religion::class, 'rlg_id', 'fml_father_religion_id');
    }
    public function motherReligion()
    {
        return $this->hasOne(Religion::class, 'rlg_id', 'fml_mother_religion_id');
    }

}
