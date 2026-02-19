<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhysicalCondition extends Model
{
    
    protected $table = 'physical_conditions';
    protected $primaryKey = 'phy_id';
    protected $guarded = [];

    const CREATED_AT = 'phy_created_at';
    const UPDATED_AT = 'phy_updated_at';
    const DELETED_AT = 'phy_deleted_at';
}
