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
        Schema::create('ppdb_applications', function (Blueprint $table) {
            $table->bigIncrements('ppa_id');
            $table->unsignedBigInteger('ppa_std_id');
            $table->foreign('ppa_std_id')->references('std_id')->on('students')->onDelete('cascade');
            $table->unsignedBigInteger('ppa_ppdb_id');
            $table->foreign('ppa_ppdb_id')->references('ppd_id')->on('ppdbs')->onDelete('cascade');
            $table->unsignedBigInteger('ppa_major_id');
            $table->foreign('ppa_major_id')->references('mjr_id')->on('majors')->onDelete('cascade');
            $table->string('ppa_reason');

            $table->timestamps();
            $table->renameColumn('updated_at', 'ppa_updated_at');
            $table->renameColumn('created_at', 'ppa_created_at');
            $table->unsignedBigInteger('ppa_created_by')->nullable();
            $table->unsignedBigInteger('ppa_deleted_by')->nullable();
            $table->unsignedBigInteger('ppa_updated_by')->nullable();
            $table->softDeletes(); // gunakan deleted_at
            $table->renameColumn('deleted_at', 'ppa_deleted_at');
            $table->string('ppa_sys_note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppdb_applications');
    }
};
