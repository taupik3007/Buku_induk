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
        Schema::create('admission_information', function (Blueprint $table) {
            $table->bigIncrements('adm_id');
            $table->unsignedBigInteger('adm_user_id');
            $table->foreign('adm_user_id')->references('usr_id')->on('users')->onDelete('cascade');
            $table->bigInteger('adm_addmitted');
            $table->string('adm_grade');
            $table->string('adm_group');
            $table->string('adm_major');
            $table->timestamps();
            $table->renameColumn('updated_at', 'adm_updated_at');
            $table->renameColumn('created_at', 'adm_created_at');
            $table->unsignedBigInteger('adm_created_by')->nullable();
            $table->unsignedBigInteger('adm_deleted_by')->nullable();
            $table->unsignedBigInteger('adm_updated_by')->nullable();
            $table->softDeletes(); // gunakan deleted_at
            $table->renameColumn('deleted_at', 'adm_deleted_at');
            $table->string('adm_sys_note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admission__information');
    }
};
