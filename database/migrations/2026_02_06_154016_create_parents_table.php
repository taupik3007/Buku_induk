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
       Schema::create('families', function (Blueprint $table) {
    $table->bigIncrements('fml_id');

    $table->unsignedBigInteger('fml_student_id');
    $table->foreign('fml_student_id')
        ->references('std_id')
        ->on('students')
        ->onDelete('cascade');

    $table->bigInteger('fml_birth_order');
    $table->bigInteger('fml_sibling');
    $table->bigInteger('fml_step_sibling');
    $table->bigInteger('fml_adoptive_sibling');
    $table->bigInteger('fml_status');
    $table->string('fml_father_name')->nullable();
    $table->unsignedBigInteger('fml_father_religion_id')->nullable();
    $table->foreign('fml_father_religion_id')->references('rlg_id')->on('religions')->onDelete('cascade');
    $table->string('fml_father_nationality')->nullable();
    $table->string('fml_father_education')->nullable();
    $table->string('fml_father_occupation')->nullable();
    $table->bigInteger('fml_father_income')->nullable();
    $table->string('fml_father_address')->nullable();
    $table->string('fml_father_phone')->nullable();
    $table->string('fml_father_status')->nullable();
    $table->string('fml_mother_name')->nullable();
    $table->unsignedBigInteger('fml_mother_religion_id')->nullable();
    $table->foreign('fml_mother_religion_id')->references('rlg_id')->on('religions')->onDelete('cascade');
    $table->string('fml_mother_nationality')->nullable();
    $table->string('fml_mother_education')->nullable();
    $table->string('fml_mother_occupation')->nullable();
    $table->bigInteger('fml_mother_income')->nullable();
    $table->string('fml_mother_address')->nullable();
    $table->string('fml_mother_phone')->nullable();
    $table->string('fml_mother_status')->nullable();
    $table->string('fml_guardian_name')->nullable();
    $table->unsignedBigInteger('fml_guardian_religion_id')->nullable();
    $table->foreign('fml_guardian_religion_id')->references('rlg_id')->on('religions')->onDelete('cascade');
    $table->string('fml_guardian_nationality')->nullable();
    $table->string('fml_guardian_education')->nullable();
    $table->string('fml_guardian_occupation')->nullable();
    $table->bigInteger('fml_guardian_income')->nullable();
    $table->string('fml_guardian_address')->nullable();
    $table->string('fml_guardian_phone')->nullable();

    $table->timestamp('fml_created_at')->nullable();
    $table->timestamp('fml_updated_at')->nullable();
    $table->timestamp('fml_deleted_at')->nullable();

    $table->unsignedBigInteger('fml_created_by')->nullable();
    $table->unsignedBigInteger('fml_updated_by')->nullable();
    $table->unsignedBigInteger('fml_deleted_by')->nullable();

    $table->string('fml_sys_note')->nullable();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('families');
    }
};
