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
        Schema::create('teacher_submissions', function (Blueprint $table) {
            $table->bigIncrements('tsb_id');
            $table->unsignedBigInteger('tsb_teacher_id');
            $table->foreign('tsb_teacher_id')->references('tcr_id')->on('teachers')->onDelete('cascade');
            $table->unsignedBigInteger('tsb_requirement_id');
            $table->foreign('tsb_requirement_id')->references('tcq_id')->on('teacher_requirements')->onDelete('cascade');
            $table->string('tsb_value');
            $table->enum('tsb_status', ['pending','approved','rejected'])->default('pending');
            $table->string('tsb_note')->nullable();
            $table->timestamps();
            $table->renameColumn('updated_at', 'tsb_updated_at');
            $table->renameColumn('created_at', 'tsb_created_at');
            $table->unsignedBigInteger('tsb_created_by')->nullable();
            $table->unsignedBigInteger('tsb_deleted_by')->nullable();
            $table->unsignedBigInteger('tsb_updated_by')->nullable();
            $table->softDeletes(); // gunakan deleted_at
            $table->renameColumn('deleted_at', 'tsb_deleted_at');
            $table->string('tsb_sys_note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_submissions');
    }
};
