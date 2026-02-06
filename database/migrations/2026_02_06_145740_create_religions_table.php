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
        Schema::create('religions', function (Blueprint $table) {
            $table->bigIncrements('rlg_id');
            $table->string('rlg_name');
            $table->timestamps();
            $table->renameColumn('updated_at', 'rlg_updated_at');
            $table->renameColumn('created_at', 'rlg_created_at');
            $table->unsignedBigInteger('rlg_created_by')->nullable();
            $table->unsignedBigInteger('rlg_deleted_by')->nullable();
            $table->unsignedBigInteger('rlg_updated_by')->nullable();
            $table->softDeletes(); // gunakan deleted_at
            $table->renameColumn('deleted_at', 'rlg_deleted_at');
            $table->string('rlg_sys_note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('religions');
    }
};
