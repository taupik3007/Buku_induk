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
        Schema::create('prospective_student_requirements', function (Blueprint $table) {
            $table->bigIncrements('psr_id');
            $table->unsignedBigInteger('psr_std_id');
            $table->foreign('psr_std_id')->references('std_id')->on('students')->onDelete('cascade');
            $table->string('psr_value');
            $table->unsignedBigInteger('psr_requirement_id');
            $table->foreign('psr_requirement_id')->references('pdr_id')->on('ppdb_requirements')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prospective_student_requirements');
    }
};
