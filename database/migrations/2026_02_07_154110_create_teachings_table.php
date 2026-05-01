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
        Schema::create('teachings', function (Blueprint $table) {
            $table->bigIncrements('tch_id');
            $table->unsignedBigInteger('tch_employee_id');
            $table->foreign('tch_employee_id')->references('tce_id')->on('teacher_employees')->onDelete('cascade');
            $table->unsignedBigInteger('tch_subject_id');
            $table->foreign('tch_subject_id')->references('sbj_id')->on('subjects')->onDelete('cascade');
            $table->unsignedBigInteger('tch_academic_id');
            $table->foreign('tch_academic_id')->references('acy_id')->on('academic_years')->onDelete('cascade');
            $table->bigInteger('tch_teach_time');
            $table->bigInteger('tch_level');
            $table->timestamps();
            $table->renameColumn('updated_at', 'tch_updated_at');
            $table->renameColumn('created_at', 'tch_created_at');
            $table->unsignedBigInteger('tch_created_by')->nullable();
            $table->unsignedBigInteger('tch_deleted_by')->nullable();
            $table->unsignedBigInteger('tch_updated_by')->nullable();
            $table->softDeletes(); // gunakan deleted_at
            $table->renameColumn('deleted_at', 'tch_deleted_at');
            $table->string('tch_sys_note')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachings');
    }
};
