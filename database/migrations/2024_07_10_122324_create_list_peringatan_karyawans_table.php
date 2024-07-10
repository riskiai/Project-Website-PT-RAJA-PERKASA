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
        Schema::create('list_peringatan_karyawans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('cuti_id')->nullable();
            $table->foreign('cuti_id')->references('id')->on('cutis');
            $table->unsignedBigInteger('absen_id')->nullable();
            $table->foreign('absen_id')->references('id')->on('absen_karyawans');
            $table->enum('jenis_peringatan', ['peringatan_peneguran', 'peringatan_pemanggilan', 'peringatan_pemberhentian'])->nullable();
            $table->enum('status_karyawan', ['aktif', 'diberhentikan'])->nullable();
            $table->string('file_peringatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('list_peringatan_karyawans');
    }
};
