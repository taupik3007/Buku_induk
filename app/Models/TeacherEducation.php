<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeacherEducation extends Model
{
    use HasFactory, SoftDeletes ;
    protected $table = 'teach_education';
    protected $primaryKey = 'tce_id';
    protected $guarded = [];

    const CREATED_AT = 'tce_created_at';
    const UPDATED_AT = 'tce_updated_at';
    const DELETED_AT = 'tce_deleted_at';

    public function bio()
    {
        return $this->belongsTo(Teacher_Bio::class, 'tca_bio_id', 'tcb_id');
    }
}
