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
        Schema::create('datalegalitas', function (Blueprint $table) {
            $table->id();
            $table->string('no_akta')->nullable();
            $table->string('file_akta')->nullable();
            $table->string('no_siup')->nullable();
            $table->string('file_siup')->nullable();
            $table->date('date_end_siup')->nullable();
            $table->string('no_tdp')->nullable();
            $table->string('file_tdp')->nullable();
            $table->date('date_end_tdp')->nullable();
            $table->string('no_skdp')->nullable();
            $table->string('file_skdp')->nullable();
            $table->date('date_end_skdp')->nullable();
            $table->string('no_iujk')->nullable();
            $table->string('file_iujk')->nullable();
            $table->date('date_end_iujk')->nullable();
            $table->string('file_profile_perusahaan')->nullable();
            $table->string('file_dokumen_kebenaran')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datalegalitas');
    }
};
