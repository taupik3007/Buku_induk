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
        Schema::create('teachers', function (Blueprint $table) {
            $table->bigIncrements('tcr_id');
            $table->unsignedBigInteger('tcr_user_id');
            $table->foreign('tcr_user_id')->references('usr_id')->on('users')->onDelete('cascade');
            $table->string('tcr_gtk')->unique();
            $table->string('tcr_nuptk')->nullable();
            $table->timestamps();
            $table->renameColumn('updated_at', 'tcr_updated_at');
            $table->renameColumn('created_at', 'tcr_created_at');
            $table->unsignedBigInteger('tcr_created_by')->nullable();
            $table->unsignedBigInteger('tcr_deleted_by')->nullable();
            $table->unsignedBigInteger('tcr_updated_by')->nullable();
            $table->softDeletes(); // gunakan deleted_at
            $table->renameColumn('deleted_at', 'tcr_deleted_at');
            $table->string('tcr_sys_note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
