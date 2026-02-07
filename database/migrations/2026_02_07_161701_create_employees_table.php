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
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('emp_id');
            $table->string('emp_nuptk');
            $table->bigInteger('emp_gtk');
            $table->bigInteger('emp_nik');
            $table->timestamps();
            $table->renameColumn('updated_at', 'emp_updated_at');
            $table->renameColumn('created_at', 'emp_created_at');
            $table->unsignedBigInteger('emp_created_by')->nullable();
            $table->unsignedBigInteger('emp_deleted_by')->nullable();
            $table->unsignedBigInteger('emp_updated_by')->nullable();
            $table->softDeletes(); // gunakan deleted_at
            $table->renameColumn('deleted_at', 'emp_deleted_at');
            $table->string('emp_sys_note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
