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
        Schema::create('sertificates', function (Blueprint $table) {
            $table->bigIncrements('stf_id');
            $table->string('stf_name');
            $table->string('stf_value');
            $table->unsignedBigInteger('stf_std_id');
            $table->foreign('stf_std_id')->references('std_id')->on('students')->onDelete('cascade');

            $table->timestamps();
            $table->renameColumn('updated_at', 'stf_updated_at');
            $table->renameColumn('created_at', 'stf_created_at');
            $table->unsignedBigInteger('stf_created_by')->nullable();
            $table->unsignedBigInteger('stf_deleted_by')->nullable();
            $table->unsignedBigInteger('stf_updated_by')->nullable();
            $table->softDeletes(); // gunakan deleted_at
            $table->renameColumn('deleted_at', 'stf_deleted_at');
            $table->string('stf_sys_note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sertificates');
    }
};
