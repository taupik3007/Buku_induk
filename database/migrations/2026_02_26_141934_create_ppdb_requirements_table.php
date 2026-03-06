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
        Schema::create('ppdb_requirements', function (Blueprint $table) {
            $table->bigIncrements('pdr_id');
            $table->unsignedBigInteger('pdr_ppdb_id');
            $table->foreign('pdr_ppdb_id')->references('ppd_id')->on('ppdbs')->onDelete('cascade');
            $table->string('pdr_name');
            $table->string('pdr_type');

            $table->timestamps();
            $table->renameColumn('updated_at', 'pdr_updated_at');
            $table->renameColumn('created_at', 'pdr_created_at');
            $table->unsignedBigInteger('pdr_created_by')->nullable();
            $table->unsignedBigInteger('pdr_deleted_by')->nullable();
            $table->unsignedBigInteger('pdr_updated_by')->nullable();
            $table->softDeletes(); // gunakan deleted_at
            $table->renameColumn('deleted_at', 'pdr_deleted_at');
            $table->string('pdr_sys_note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppdb_requirements');
    }
};
