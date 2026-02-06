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
        Schema::create('leaving_schools', function (Blueprint $table) {
            $table->bigIncrements('lvg_id');
            $table->unsignedBigInteger('lvg_user_id');
            $table->foreign('lvg_user_id')->references('usr_id')->on('users')->onDelete('cascade');
            $table->date('lvg_leaving_date');
            $table->string('lvg_reason');
            $table->timestamps();
            $table->renameColumn('updated_at', 'lvg_updated_at');
            $table->renameColumn('created_at', 'lvg_created_at');
            $table->unsignedBigInteger('lvg_created_by')->nullable();
            $table->unsignedBigInteger('lvg_deleted_by')->nullable();
            $table->unsignedBigInteger('lvg_updated_by')->nullable();
            $table->softDeletes(); // gunakan deleted_at
            $table->renameColumn('deleted_at', 'lvg_deleted_at');
            $table->string('lvg_sys_note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaving__schools');
    }
};
