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
        Schema::create('teacher_employees', function (Blueprint $table) {
            $table->bigIncrements('tce_id');
            $table->bigInteger('tce_tmt');
            $table->string('tce_no_sk');
            $table->string('tce_duration');
            $table->string('tce_length_service');
            $table->string('tce_status');
            $table->string('tce_position');
            $table->string('tce_inpasign');
            $table->string('tce_additional_task');
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
        Schema::dropIfExists('teacher__employees');
    }
};
