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
        Schema::create('cutis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->text('alasan_cuti')->nullable();
            $table->enum('status_cuti', ['disetujui', 'tidak_disetujui', 'belumdicek'])->nullable()->default('belumdicek');
            $table->string('file_cuti')->nullable();
            $table->string('file_balasan')->nullable();
            $table->string('lokasi_area_kerja');
            $table->date('pengambilan_cuti_tgl');
            $table->date('masuk_kembali_tgl');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cutis');
    }
};
