<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('teacher_addresses', function (Blueprint $table) {
            $table->bigIncrements('tca_id');
            $table->unsignedBigInteger('tca_teacher_id');
            $table->foreign('tca_teacher_id')->references('tcr_id')->on('teachers')->onDelete('cascade');
            $table->string('tca_detail');
            $table->string('tca_province');
            $table->string('tca_province_value');
            $table->string('tca_regency');
            $table->string('tca_regency_value');
            $table->string('tca_district');
            $table->string('tca_district_value');
            $table->string('tca_village');
            $table->string('tca_village_value');
            $table->bigInteger('tca_postalcode');
            $table->bigInteger('tca_distance');
            $table->string('tca_rt')->nullable();
            $table->string('tca_rw')->nullable();
           
            $table->timestamps();
            $table->renameColumn('updated_at', 'tca_updated_at');
            $table->renameColumn('created_at', 'tca_created_at');
            $table->unsignedBigInteger('tca_created_by')->nullable();
            $table->unsignedBigInteger('tca_deleted_by')->nullable();
            $table->unsignedBigInteger('tca_updated_by')->nullable();
            $table->softDeletes(); // gunakan deleted_at
            $table->renameColumn('deleted_at', 'tca_deleted_at');
            $table->string('tca_sys_note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher__addresses');
    }
};
