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
        Schema::create('addresses', function (Blueprint $table) {
            $table->bigIncrements('adr_id');
            $table->unsignedBigInteger('adr_user_id');
            $table->foreign('adr_user_id')->references('usr_id')->on('users')->onDelete('cascade');
            $table->string('adr_detail');
            $table->string('adr_village');
            $table->string('adr_district');
            $table->string('adr_regency');
            $table->string('adr_province');
            $table->bigInteger('adr_postal_code');
            $table->bigInteger('adr_distance');
            $table->timestamps();
            $table->renameColumn('updated_at', 'adr_updated_at');
            $table->renameColumn('created_at', 'adr_created_at');
            $table->unsignedBigInteger('adr_created_by')->nullable();
            $table->unsignedBigInteger('adr_deleted_by')->nullable();
            $table->unsignedBigInteger('adr_updated_by')->nullable();
            $table->softDeletes(); // gunakan deleted_at
            $table->renameColumn('deleted_at', 'adr_deleted_at');
            $table->string('adr_sys_note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
