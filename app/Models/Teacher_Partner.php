<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher_Partner extends Model
{
    use HasFactory, SoftDeletes ;
    protected $table = 'teacher_partners';
    protected $primaryKey = 'tcp_id';
    protected $guarded = [];

    const CREATED_AT = 'tcp_created_at';
    const UPDATED_AT = 'tcp_updated_at';
    const DELETED_AT = 'tcp_deleted_at';

    public function bio()
    {
        return $this->belongsTo(Teacher_Bio::class, 'tcp_bio_id', 'tcb_id');
    }
}
