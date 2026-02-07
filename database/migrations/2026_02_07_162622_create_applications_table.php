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
        Schema::create('applications', function (Blueprint $table) {
            $table->bigIncrements('apl_id');
            $table->unsignedBigInteger('apl_user_id');
            $table->foreign('apl_user_id')->references('usr_id')->on('users')->onDelete('cascade');
            $table->bigInteger('apl_position');
            $table->bigInteger('apl_type_subject');
            $table->unsignedBigInteger('apl_subject_id');
            $table->foreign('apl_subject_id')->references('sbj_id')->on('subjects')->onDelete('cascade');
            $table->unsignedBigInteger('apl_major_id');
            $table->foreign('apl_major_id')->references('mjr_id')->on('majors')->onDelete('cascade');
            $table->timestamps();
            $table->renameColumn('updated_at', 'apl_updated_at');
            $table->renameColumn('created_at', 'apl_created_at');
            $table->unsignedBigInteger('apl_created_by')->nullable();
            $table->unsignedBigInteger('apl_deleted_by')->nullable();
            $table->unsignedBigInteger('apl_updated_by')->nullable();
            $table->softDeletes(); // gunakan deleted_at
            $table->renameColumn('deleted_at', 'apl_deleted_at');
            $table->string('apl_sys_note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
