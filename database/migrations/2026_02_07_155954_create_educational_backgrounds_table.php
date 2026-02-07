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
        Schema::create('educational_backgrounds', function (Blueprint $table) {
            $table->bigIncrements('edb_id');
            $table->unsignedBigInteger('edb_teacher_id');
            $table->foreign('edb_teacher_id')->references('tcr_id')->on('teachers')->onDelete('cascade');
            $table->bigInteger('edb_level');
            $table->string('edb_educational_unit_name');
            $table->year('edb_year');
            $table->string('edb_degree');
            $table->timestamps();
            $table->renameColumn('updated_at', 'edb_updated_at');
            $table->renameColumn('created_at', 'edb_created_at');
            $table->unsignedBigInteger('edb_created_by')->nullable();
            $table->unsignedBigInteger('edb_deleted_by')->nullable();
            $table->unsignedBigInteger('edb_updated_by')->nullable();
            $table->softDeletes(); // gunakan deleted_at
            $table->renameColumn('deleted_at', 'edb_deleted_at');
            $table->string('edb_sys_note')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('educational_backgrounds');
    }
};
