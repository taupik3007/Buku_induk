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
        Schema::create('ppdb_submissions', function (Blueprint $table) {
            $table->bigIncrements('pps_id');
            $table->unsignedBigInteger('pps_ppdb_id');
            $table->foreign('pps_ppdb_id')->references('ppd_id')->on('ppdbs')->onDelete('cascade');
            $table->unsignedBigInteger('pps_student_id');
            $table->foreign('pps_student_id')->references('std_id')->on('students')->onDelete('cascade');
            $table->unsignedBigInteger('pps_major_id');
            $table->foreign('pps_major_id')->references('mjr_id')->on('majors')->onDelete('cascade');
            $table->string('pps_reason');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppdb_submissions');
    }
};
