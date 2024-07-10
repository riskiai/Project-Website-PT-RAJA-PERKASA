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
        Schema::create('absen_karyawans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->date('tanggal_absen')->nullable();
            $table->enum('status_absensi', ['hadir', 'izin', 'sakit', 'tidak_hadir'])->default('tidak_hadir');
            $table->string('bukti_kehadiran', 255)->nullable();
            $table->string('surat_izin_sakit', 255)->nullable();
            $table->datetime('waktu_datang_kehadiran')->nullable();
            $table->datetime('waktu_pulang_kehadiran')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absen_karyawans');
    }
};
