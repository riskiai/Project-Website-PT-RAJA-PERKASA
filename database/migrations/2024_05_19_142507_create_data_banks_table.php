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
        Schema::create('data_banks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pemilik_rekening')->nullable();
            $table->integer('no_rekening')->nullable();
            $table->string('nama_bank')->nullable();
            $table->string('cabang_bank')->nullable();
            $table->text('alamat_bank')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_banks');
    }
};
