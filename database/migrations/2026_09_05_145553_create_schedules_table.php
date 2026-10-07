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
        Schema::create('schedules', function (Blueprint $table) {
            $table->bigIncrements('sch_id');

            $table->unsignedBigInteger('sch_subject_teacher_id');
            $table->unsignedBigInteger('sch_slot_id');

            $table->foreign('sch_subject_teacher_id')
                ->references('subt_id')
                ->on('subject_teachers')
                ->onDelete('cascade');

            $table->foreign('sch_slot_id')
                ->references('slt_id')
                ->on('schedule_slots')
                ->onDelete('cascade');

            $table->timestamps();

            $table->renameColumn('created_at', 'sch_created_at');
            $table->renameColumn('updated_at', 'sch_updated_at');

            $table->unsignedBigInteger('sch_created_by')->nullable();
            $table->unsignedBigInteger('sch_updated_by')->nullable();

            $table->foreign('sch_created_by')
                ->references('usr_id')
                ->on('users')
                ->nullOnDelete();

            $table->foreign('sch_updated_by')
                ->references('usr_id')
                ->on('users')
                ->nullOnDelete();

            $table->string('sch_sys_note')->nullable();

            $table->unique(
                ['sch_subject_teacher_id', 'sch_slot_id'],
                'sch_subject_teacher_slot_unique'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
