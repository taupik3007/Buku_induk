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
        Schema::create('schedule_slots', function (Blueprint $table) {
            $table->bigIncrements('slt_id');

            $table->unsignedTinyInteger('slt_day');
            $table->unsignedTinyInteger('slt_number')->nullable();

            $table->time('slt_start_time');
            $table->time('slt_end_time');

            $table->string('slt_type', 20)->default('lesson');

            $table->timestamps();

            $table->renameColumn('updated_at', 'slt_updated_at');
            $table->renameColumn('created_at', 'slt_created_at');

            $table->unsignedBigInteger('slt_created_by')->nullable();
            $table->unsignedBigInteger('slt_deleted_by')->nullable();
            $table->unsignedBigInteger('slt_updated_by')->nullable();

            $table->softDeletes();
            $table->renameColumn('deleted_at', 'slt_deleted_at');

            $table->string('slt_sys_note')->nullable();

            $table->foreign('slt_created_by')
                ->references('usr_id')
                ->on('users')
                ->nullOnDelete();

            $table->foreign('slt_updated_by')
                ->references('usr_id')
                ->on('users')
                ->nullOnDelete();

            $table->foreign('slt_deleted_by')
                ->references('usr_id')
                ->on('users')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
