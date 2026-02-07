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
        Schema::create('schools', function (Blueprint $table) {
            $table->bigIncrements('sch_id');
            $table->string('sch_name');
            $table->string('sch_address');
            $table->string('sch_village');
            $table->string('sch_district');
            $table->string('sch_regency');
            $table->string('sch_province');
            $table->unsignedBigInteger('sch_headmaster_id');
            $table->foreign('sch_headmaster_id')->references('usr_id')->on('users')->onDelete('cascade');
            $table->string('sch_nip_headmaster');
            $table->timestamps();
            $table->renameColumn('updated_at', 'sch_updated_at');
            $table->renameColumn('created_at', 'sch_created_at');
            $table->unsignedBigInteger('sch_created_by')->nullable();
            $table->unsignedBigInteger('sch_deleted_by')->nullable();
            $table->unsignedBigInteger('sch_updated_by')->nullable();
            $table->softDeletes(); // gunakan deleted_at
            $table->renameColumn('deleted_at', 'sch_deleted_at');
            $table->string('sch_sys_note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schools');
    }
};
