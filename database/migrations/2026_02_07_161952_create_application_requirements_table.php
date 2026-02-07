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
        Schema::create('application_requirements', function (Blueprint $table) {
            $table->bigIncrements('apr_id');
            $table->string('apr_name');
            $table->string('apr_type');
            $table->timestamps();
            $table->renameColumn('updated_at', 'apr_updated_at');
            $table->renameColumn('created_at', 'apr_created_at');
            $table->unsignedBigInteger('apr_created_by')->nullable();
            $table->unsignedBigInteger('apr_deleted_by')->nullable();
            $table->unsignedBigInteger('apr_updated_by')->nullable();
            $table->softDeletes(); // gunakan deleted_at
            $table->renameColumn('deleted_at', 'apr_deleted_at');
            $table->string('apr_sys_note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application_requirements');
    }
};
