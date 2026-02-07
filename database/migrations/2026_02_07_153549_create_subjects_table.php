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
        Schema::create('subjects', function (Blueprint $table) {
            $table->bigIncrements('sbj_id');
            $table->string('sbj_name');
            $table->string('sbj_code');
            $table->bigInteger('sbj_level');
            $table->unsignedBigInteger('sbj_major_id');
            $table->foreign('sbj_major_id')->references('mjr_id')->on('majors')->onDelete('cascade');
            $table->bigInteger('sbj_jp');
            $table->timestamps();
            $table->renameColumn('updated_at', 'sbj_updated_at');
            $table->renameColumn('created_at', 'sbj_created_at');
            $table->unsignedBigInteger('sbj_created_by')->nullable();
            $table->unsignedBigInteger('sbj_deleted_by')->nullable();
            $table->unsignedBigInteger('sbj_updated_by')->nullable();
            $table->softDeletes(); // gunakan deleted_at
            $table->renameColumn('deleted_at', 'sbj_deleted_at');
            $table->string('sbj_sys_note')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
