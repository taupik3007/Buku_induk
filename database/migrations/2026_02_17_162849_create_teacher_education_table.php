<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('teacher_education', function (Blueprint $table) {
            $table->bigIncrements('tce_id');
            $table->unsignedBigInteger('tce_teacher_id');
            $table->foreign('tce_teacher_id')->references('tcr_id')->on('teachers')->onDelete('cascade');
            $table->string('tce_level');          
            $table->string('tce_institution');    
            $table->year('tce_graduation_year'); 
            $table->string('tce_major')->nullable(); 
            $table->string('tce_degree')->nullable(); 

            $table->timestamps();
            $table->renameColumn('updated_at', 'tce_updated_at');
            $table->renameColumn('created_at', 'tce_created_at');
            $table->unsignedBigInteger('tce_created_by')->nullable();
            $table->unsignedBigInteger('tce_deleted_by')->nullable();
            $table->unsignedBigInteger('tce_updated_by')->nullable();
            $table->softDeletes(); // gunakan deleted_at
            $table->renameColumn('deleted_at', 'tce_deleted_at');
            $table->string('tce_sys_note')->nullable();
        });
    } 

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_education');
    }
};
