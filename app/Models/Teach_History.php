<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teach_History extends Model
{
    use HasFactory, SoftDeletes ;
    protected $table = 'teach_histories';
    protected $primaryKey = 'tcs_id';
    protected $guarded = [];

    const CREATED_AT = 'tcs_created_at';
    const UPDATED_AT = 'tcs_updated_at';
    const DELETED_AT = 'tcs_deleted_at';

    public function bio()
    {
        return $this->belongsTo(Teacher_Bio::class, 'tca_bio_id', 'tcb_id');
    }
}
