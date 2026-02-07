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
        Schema::create('teach_histories', function (Blueprint $table) {
            $table->bigIncrements('tcs_id');
            $table->string('tcs_subject_name');
            $table->string('tcs_name_school');
            $table->string('tcs_class');
            $table->string('tcs_jp');
            $table->year('tcs_year');
            $table->timestamps();
            $table->renameColumn('updated_at', 'tcs_updated_at');
            $table->renameColumn('created_at', 'tcs_created_at');
            $table->unsignedBigInteger('tcs_created_by')->nullable();
            $table->unsignedBigInteger('tcs_deleted_by')->nullable();
            $table->unsignedBigInteger('tcs_updated_by')->nullable();
            $table->softDeletes(); // gunakan deleted_at
            $table->renameColumn('deleted_at', 'tcs_deleted_at');
            $table->string('tcs_sys_note')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teach__histories');
    }
};
