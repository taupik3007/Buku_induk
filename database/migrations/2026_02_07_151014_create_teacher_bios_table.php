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
        Schema::create('teacher_bios', function (Blueprint $table) {
            $table->bigIncrements('tcb_id');
            $table->unsignedBigInteger('tcb_teacher_id');
            $table->foreign('tcb_teacher_id')->references('tcr_id')->on('teachers')->onDelete('cascade');
            $table->string('tcb_birth_place');
            $table->date('tcb_birth_date');
            $table->string('tcb_religion');
            // $table->unsignedBigInteger('tcb_religion_id');
            // $table->foreign('tcb_religion_id')->references('rlg_id')->on('religions')->onDelete('cascade');
            $table->bigInteger('tcb_mary_status');
            $table->bigInteger('tcb_gender');
            $table->bigInteger('tcb_telp');
            $table->enum('tcb_status', ['draft','pending','revision','accepted','rejected'
            ])->default('draft');
            $table->timestamps();
            $table->renameColumn('updated_at', 'tcb_updated_at');
            $table->renameColumn('created_at', 'tcb_created_at');
            $table->unsignedBigInteger('tcb_created_by')->nullable();
            $table->unsignedBigInteger('tcb_deleted_by')->nullable();
            $table->unsignedBigInteger('tcb_updated_by')->nullable();
            $table->softDeletes(); // gunakan deleted_at
            $table->renameColumn('deleted_at', 'tcb_deleted_at');
            $table->string('tcb_sys_note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher__bios');
    }
};
