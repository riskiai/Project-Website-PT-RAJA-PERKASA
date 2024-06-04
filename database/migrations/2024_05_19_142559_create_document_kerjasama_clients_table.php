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
        Schema::create('document_kerjasama_clients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('data_sales_id')->nullable();
            $table->foreign('data_sales_id')->references('id')->on('data_sales');
            $table->unsignedBigInteger('data_manajer_id')->nullable();
            $table->foreign('data_manajer_id')->references('id')->on('data_manajers');
            $table->unsignedBigInteger('data_direktur_id')->nullable();
            $table->foreign('data_direktur_id')->references('id')->on('data_direktur_utamas');
            $table->unsignedBigInteger('data_bank_id')->nullable();
            $table->foreign('data_bank_id')->references('id')->on('data_banks');
            $table->unsignedBigInteger('data_legalitas_id')->nullable();
            $table->foreign('data_legalitas_id')->references('id')->on('datalegalitas');
            $table->enum('status_kerjasama', ['ditunggu', 'diterima', 'ditolak'])->nullable()->default('ditunggu');
            $table->string('keterangan_status_kerjasama')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_kerjasama_clients');
    }
};
