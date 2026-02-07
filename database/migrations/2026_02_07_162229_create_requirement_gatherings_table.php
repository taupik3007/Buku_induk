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
        Schema::create('requirement_gatherings', function (Blueprint $table) {
            $table->bigIncrements('rqg_id');
            $table->unsignedBigInteger('rpq_aplicate_id');
            $table->foreign('rpq_aplicate_id')->references('apr_id')->on('application_requirements')->onDelete('cascade');
            $table->string('rpq_content');
            $table->unsignedBigInteger('rpq_user_id');
            $table->foreign('rpq_user_id')->references('usr_id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->renameColumn('updated_at', 'rpq_updated_at');
            $table->renameColumn('created_at', 'rpq_created_at');
            $table->unsignedBigInteger('rpq_created_by')->nullable();
            $table->unsignedBigInteger('rpq_deleted_by')->nullable();
            $table->unsignedBigInteger('rpq_updated_by')->nullable();
            $table->softDeletes(); // gunakan deleted_at
            $table->renameColumn('deleted_at', 'rpq_deleted_at');
            $table->string('rpq_sys_note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requirement_gatherings');
    }
};
