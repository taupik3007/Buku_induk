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
        Schema::create('completed_educations', function (Blueprint $table) {
            $table->bigIncrements('cpd_id');
            $table->unsignedBigInteger('cpd_user_id');
            $table->foreign('cpd_user_id')->references('usr_id')->on('users')->onDelete('cascade');
            $table->string('cpd_continued_to');
            $table->date('cpd_started_working');
            $table->string('cpd_company_name');
            $table->bigInteger('cpd_income');
            $table->timestamps();
            $table->renameColumn('updated_at', 'cpd_updated_at');
            $table->renameColumn('created_at', 'cpd_created_at');
            $table->unsignedBigInteger('cpd_created_by')->nullable();
            $table->unsignedBigInteger('cpd_deleted_by')->nullable();
            $table->unsignedBigInteger('cpd_updated_by')->nullable();
            $table->softDeletes(); // gunakan deleted_at
            $table->renameColumn('deleted_at', 'cpd_deleted_at');
            $table->string('cpd_sys_note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('completed__education');
    }
};
