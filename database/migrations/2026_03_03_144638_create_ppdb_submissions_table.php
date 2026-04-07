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
            $table->bigIncrements('ppsu_id');
            $table->unsignedBigInteger('ppsu_ppdb_id')->nullable();
            $table->foreign('ppsu_ppdb_id')->references('ppd_id')->on('ppdbs')->onDelete('cascade');
            $table->unsignedBigInteger('ppsu_student_id');
            $table->foreign('ppsu_student_id')->references('std_id')->on('students')->onDelete('cascade');
            $table->unsignedBigInteger('ppsu_major_id')->nullable();
            $table->foreign('ppsu_major_id')->references('mjr_id')->on('majors')->onDelete('cascade');
            $table->string('ppsu_reason')->nullable();
            $table->tinyInteger('ppsu_status')->default(0);
        // 0 = pending, 1 = diterima, 2 = ditolak
            $table->timestamps();
            $table->renameColumn('updated_at', 'ppsu_updated_at');
            $table->renameColumn('created_at', 'ppsu_created_at');
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
