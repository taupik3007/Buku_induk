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
        Schema::create('ppdbs', function (Blueprint $table) {
            $table->bigIncrements('ppd_id');
            $table->unsignedBigInteger('ppd_academic_id');
            $table->foreign('ppd_academic_id')->references('acy_id')->on('academic_years')->onDelete('cascade');
            $table->date('ppd_start_date');
            $table->date('ppd_end_date');
            $table->bigInteger('ppd_entry_fee');
            
            $table->timestamps();
            $table->renameColumn('updated_at', 'ppd_updated_at');
            $table->renameColumn('created_at', 'ppd_created_at');
            $table->unsignedBigInteger('ppd_created_by')->nullable();
            $table->unsignedBigInteger('ppd_deleted_by')->nullable();
            $table->unsignedBigInteger('ppd_updated_by')->nullable();
            $table->softDeletes(); // gunakan deleted_at
            $table->renameColumn('deleted_at', 'ppd_deleted_at');
            $table->string('ppd_sys_note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppdbs');
    }
};
