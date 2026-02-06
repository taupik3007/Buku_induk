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
        Schema::create('previous_education', function (Blueprint $table) {
            $table->bigIncrements('prv_id');
            $table->unsignedBigInteger('prv_user_id');
            $table->foreign('prv_user_id')->references('usr_id')->on('users')->onDelete('cascade');
            $table->string('prv_previous_school');
            $table->date('prv_certificate_date');
            $table->bigInteger('prv_certificate_number');
            $table->string('prv_length');
            $table->string('prv_transfer');
            $table->string('prv_reason');
            $table->timestamps();
            $table->renameColumn('updated_at', 'prv_updated_at');
            $table->renameColumn('created_at', 'prv_created_at');
            $table->unsignedBigInteger('prv_created_by')->nullable();
            $table->unsignedBigInteger('prv_deleted_by')->nullable();
            $table->unsignedBigInteger('prv_updated_by')->nullable();
            $table->softDeletes(); // gunakan deleted_at
            $table->renameColumn('deleted_at', 'prv_deleted_at');
            $table->string('prv_sys_note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('previous__education');
    }
};
