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
        Schema::create('end_of_education', function (Blueprint $table) {
            $table->bigIncrements('end_id');
            $table->unsignedBigInteger('end_user_id');
            $table->foreign('end_user_id')->references('usr_id')->on('users')->onDelete('cascade');
            $table->date('end_leaving_date');
            $table->string('end_diploma_number');
            $table->timestamps();
            $table->renameColumn('updated_at', 'end_updated_at');
            $table->renameColumn('created_at', 'end_created_at');
            $table->unsignedBigInteger('end_created_by')->nullable();
            $table->unsignedBigInteger('end_deleted_by')->nullable();
            $table->unsignedBigInteger('end_updated_by')->nullable();
            $table->softDeletes(); // gunakan deleted_at
            $table->renameColumn('deleted_at', 'end_deleted_at');
            $table->string('end_sys_note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('end__of__education');
    }
};
