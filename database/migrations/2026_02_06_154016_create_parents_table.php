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
        Schema::create('parents', function (Blueprint $table) {
            $table->bigIncrements('prt_id');
            $table->unsignedBigInteger('prt_user_id');
            $table->foreign('prt_user_id')->references('usr_id')->on('users')->onDelete('cascade');
            $table->bigInteger('prn_sibling');
            $table->bigInteger('prn_step_sibling');
            $table->bigInteger('prn_adoptive_sibling');
            $table->bigInteger('prt_status');
            $table->string('prt_father_name');
            $table->string('prt_father_nationality');
            $table->string('prt_father_education');
            $table->bigInteger('prt_father_income');
            $table->string('prt_father_address');
            $table->bigInteger('prt_father_phone');
            $table->string('prt_father_status');
            $table->string('prt_mother_name');
            $table->string('prt_mother_nationality');
            $table->string('prt_mother_education');
            $table->bigInteger('prt_mother_income');
            $table->string('prt_mother_address');
            $table->bigInteger('prt_mother_phone');
            $table->string('prt_mother_status');
            $table->string('prt_guardian_name');
            $table->string('prt_guardian_nationality');
            $table->string('prt_guardian_education');
            $table->bigInteger('prt_guardian_income');
            $table->string('prt_guardian_address');
            $table->bigInteger('prt_guardian_phone');
            $table->timestamps();
            $table->renameColumn('updated_at', 'prt_updated_at');
            $table->renameColumn('created_at', 'prt_created_at');
            $table->unsignedBigInteger('prt_created_by')->nullable();
            $table->unsignedBigInteger('prt_deleted_by')->nullable();
            $table->unsignedBigInteger('prt_updated_by')->nullable();
            $table->softDeletes(); // gunakan deleted_at
            $table->renameColumn('deleted_at', 'prt_deleted_at');
            $table->string('prt_sys_note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parents');
    }
};
