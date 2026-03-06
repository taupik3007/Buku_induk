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
        Schema::create('discounts', function (Blueprint $table) {
            $table->bigIncrements('dsc_id');
            $table->string('dsc_name');
            $table->bigInteger('dsc_amount');

            $table->timestamps();
            $table->renameColumn('updated_at', 'dsc_updated_at');
            $table->renameColumn('created_at', 'dsc_created_at');
            $table->unsignedBigInteger('dsc_created_by')->nullable();
            $table->unsignedBigInteger('dsc_deleted_by')->nullable();
            $table->unsignedBigInteger('dsc_updated_by')->nullable();
            $table->softDeletes(); // gunakan deleted_at
            $table->renameColumn('deleted_at', 'dsc_deleted_at');
            $table->string('dsc_sys_note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discounts');
    }
};
