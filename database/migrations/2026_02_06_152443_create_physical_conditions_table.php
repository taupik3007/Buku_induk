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
        Schema::create('physical_conditions', function (Blueprint $table) {
            $table->bigIncrements('phy_id');
            $table->unsignedBigInteger('phy_user_id');
            $table->foreign('phy_user_id')->references('usr_id')->on('users')->onDelete('cascade');
            $table->string('phy_blood_type');
            $table->string('phy_illnes');
            $table->string('phy_disability');
            $table->bigInteger('phy_height');
            $table->bigInteger('phy_weight');
            $table->timestamps();
            $table->renameColumn('updated_at', 'phy_updated_at');
            $table->renameColumn('created_at', 'phy_created_at');
            $table->unsignedBigInteger('phy_created_by')->nullable();
            $table->unsignedBigInteger('phy_deleted_by')->nullable();
            $table->unsignedBigInteger('phy_updated_by')->nullable();
            $table->softDeletes(); // gunakan deleted_at
            $table->renameColumn('deleted_at', 'phy_deleted_at');
            $table->string('phy_sys_note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('physical__conditions');
    }
};
