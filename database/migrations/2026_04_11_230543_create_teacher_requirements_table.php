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
        Schema::create('teacher_requirements', function (Blueprint $table) {
            $table->bigIncrements('tcq_id');
            $table->string('tcq_name');
            $table->string('tcq_type');
            $table->timestamps();
            $table->renameColumn('updated_at', 'tcq_updated_at');
            $table->renameColumn('created_at', 'tcq_created_at');
            $table->unsignedBigInteger('tcq_created_by')->nullable();
            $table->unsignedBigInteger('tcq_deleted_by')->nullable();
            $table->unsignedBigInteger('tcq_updated_by')->nullable();
            $table->softDeletes(); // gunakan deleted_at
            $table->renameColumn('deleted_at', 'tcq_deleted_at');
            $table->string('tcq_sys_note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_requirements');
    }
};
