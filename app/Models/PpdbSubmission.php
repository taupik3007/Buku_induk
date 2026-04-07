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
    
     public function ppdb()
    {
        return $this->belongsTo(Ppdb::class, 'ppsu_ppdb_id', 'ppd_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'ppsu_student_id', 'std_id');
    }

    public function major()
    {
        return $this->belongsTo(Major::class, 'ppsu_major_id', 'mjr_id');
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->ppsu_status) {
            1 => 'Diterima',
            2 => 'Ditolak',
            default => 'Pending',
        };
    }
}
