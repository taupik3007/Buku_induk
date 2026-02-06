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
        Schema::create('scholarships', function (Blueprint $table) {
            $table->bigIncrements('scl_id');
            $table->unsignedBigInteger('scl_user_id');
            $table->foreign('scl_user_id')->references('usr_id')->on('users')->onDelete('cascade');
            $table->string('scl_year_1');
            $table->string('scl_grade_1');
            $table->string('scl_year_2');
            $table->string('scl_grade_2');
            $table->string('scl_year_3');
            $table->string('scl_grade_3');
            $table->timestamps();
            $table->renameColumn('updated_at', 'scl_updated_at');
            $table->renameColumn('created_at', 'scl_created_at');
            $table->unsignedBigInteger('scl_created_by')->nullable();
            $table->unsignedBigInteger('scl_deleted_by')->nullable();
            $table->unsignedBigInteger('scl_updated_by')->nullable();
            $table->softDeletes(); // gunakan deleted_at
            $table->renameColumn('deleted_at', 'scl_deleted_at');
            $table->string('scl_sys_note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scholarships');
    }
};
