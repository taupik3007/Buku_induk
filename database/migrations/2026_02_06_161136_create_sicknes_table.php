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
        Schema::create('sicknes', function (Blueprint $table) {
            $table->bigIncrements('sck_id');
            $table->unsignedBigInteger('sck_physical_id');
            $table->foreign('sck_physical_id')->references('phy_id')->on('physical_conditions')->onDelete('cascade');
            $table->string('sck_name');
            $table->timestamps();
            $table->renameColumn('updated_at', 'sck_updated_at');
            $table->renameColumn('created_at', 'sck_created_at');
            $table->unsignedBigInteger('sck_created_by')->nullable();
            $table->unsignedBigInteger('sck_deleted_by')->nullable();
            $table->unsignedBigInteger('sck_updated_by')->nullable();
            $table->softDeletes(); // gunakan deleted_at
            $table->renameColumn('deleted_at', 'sck_deleted_at');
            $table->string('sck_sys_note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sicknes');
    }
};
