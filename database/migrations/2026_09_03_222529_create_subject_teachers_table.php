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
        Schema::create('subject_teachers', function (Blueprint $table) {
            $table->bigIncrements('subt_id');

            $table->unsignedBigInteger('subt_subject_id');
            $table->unsignedBigInteger('subt_class_id');
            $table->unsignedBigInteger('subt_teacher_id');
            $table->unsignedBigInteger('subt_academic_year_id');
            $table->unsignedTinyInteger('subt_total_hours');

            $table->foreign('subt_subject_id')
                ->references('sbj_id')
                ->on('subjects')
                ->onDelete('cascade');

            $table->foreign('subt_class_id')
                ->references('cls_id')
                ->on('classes')
                ->onDelete('cascade');

            $table->foreign('subt_teacher_id')
                ->references('tcr_id')
                ->on('teachers')
                ->onDelete('cascade');

            $table->foreign('subt_academic_year_id')
                ->references('acy_id')
                ->on('academic_years')
                ->onDelete('cascade');

            $table->unique(
                [
                    'subt_subject_id',
                    'subt_class_id',
                    'subt_academic_year_id',
                ],
                'subt_subject_class_year_unique'
            );

            $table->timestamps();
            $table->renameColumn('updated_at', 'subt_updated_at');
            $table->renameColumn('created_at', 'subt_created_at');

            $table->unsignedBigInteger('subt_created_by')->nullable();
            $table->unsignedBigInteger('subt_deleted_by')->nullable();
            $table->unsignedBigInteger('subt_updated_by')->nullable();

            $table->softDeletes();
            $table->renameColumn('deleted_at', 'subt_deleted_at');

            $table->foreign('subt_created_by')
                ->references('usr_id')
                ->on('users')
                ->onDelete('set null');

            $table->foreign('subt_updated_by')
                ->references('usr_id')
                ->on('users')
                ->onDelete('set null');

            $table->foreign('subt_deleted_by')
                ->references('usr_id')
                ->on('users')
                ->onDelete('set null');
            $table->string('subt_sys_note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subject_teachers');
    }
};
