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
        Schema::create('bidang_proyeks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_bidang_pekerjaan_proyek');
            $table->enum('status_bidang_pekerjaan_proyek', ['active', 'nonactive'])->nullable()->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bidang_proyeks');
    }
};
