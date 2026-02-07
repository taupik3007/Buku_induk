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
        Schema::create('certifications', function (Blueprint $table) {
            $table->bigIncrements('cft_id');
            $table->bigInteger('cft_certificate');
            $table->string('cft_status');
            $table->year('cft_year');
            $table->bigInteger('cft_number');
            $table->bigInteger('cft_field_study');
            $table->string('cft_organizer');
            $table->timestamps();
            $table->renameColumn('updated_at', 'cft_updated_at');
            $table->renameColumn('created_at', 'cft_created_at');
            $table->unsignedBigInteger('cft_created_by')->nullable();
            $table->unsignedBigInteger('cft_deleted_by')->nullable();
            $table->unsignedBigInteger('cft_updated_by')->nullable();
            $table->softDeletes(); // gunakan deleted_at
            $table->renameColumn('deleted_at', 'cft_deleted_at');
            $table->string('cft_sys_note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certifications');
    }
};
