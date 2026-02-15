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
        Schema::create('student__biodatas', function (Blueprint $table) {
            $table->bigIncrements('stb_id');
            $table->unsignedBigInteger('stb_usr_id');
            $table->foreign('stb_usr_id')->references('usr_id')->on('users')->onDelete('cascade');
            $table->bigInteger('stb_gender');
            $table->string('stb_birth_place');
            $table->date('stb_birth_date');
            $table->unsignedBigInteger('stb_religion_id');
            $table->foreign('stb_religion_id')->references('rlg_id')->on('religions')->onDelete('cascade');
            $table->string('stb_nationality');
            $table->bigInteger('stb_birth_order');
            
            $table->string('stb_language');
            $table->bigInteger('stb_telp');
            $table->bigInteger('stb_living_with');
            $table->timestamps();
            $table->renameColumn('updated_at', 'stb_updated_at');
            $table->renameColumn('created_at', 'stb_created_at');
            $table->unsignedBigInteger('stb_created_by')->nullable();
            $table->unsignedBigInteger('stb_deleted_by')->nullable();
            $table->unsignedBigInteger('stb_updated_by')->nullable();
            $table->softDeletes(); // gunakan deleted_at
            $table->renameColumn('deleted_at', 'stb_deleted_at');
            $table->string('stb_sys_note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student__biodatas');
    }
};
