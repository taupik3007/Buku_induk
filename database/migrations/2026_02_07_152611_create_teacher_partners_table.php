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
        Schema::create('teacher_partners', function (Blueprint $table) {
            $table->bigIncrements('tcp_id');
            $table->string('tcp_name');
            $table->bigInteger('tcp_nik');
            $table->string('tcp_work');
            $table->bigInteger('tcp_nip');
            $table->timestamps();
            $table->renameColumn('updated_at', 'tcp_updated_at');
            $table->renameColumn('created_at', 'tcp_created_at');
            $table->unsignedBigInteger('tcp_created_by')->nullable();
            $table->unsignedBigInteger('tcp_deleted_by')->nullable();
            $table->unsignedBigInteger('tcp_updated_by')->nullable();
            $table->softDeletes(); // gunakan deleted_at
            $table->renameColumn('deleted_at', 'tcp_deleted_at');
            $table->string('tcp_sys_note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher__partners');
    }
};
