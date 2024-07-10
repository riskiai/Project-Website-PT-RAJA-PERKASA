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
        Schema::create('kontak_p_t_s', function (Blueprint $table) {
            $table->id();
            // $table->string('title');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('links')->nullable();
            $table->text('alamat')->nullable();
            $table->enum('status_kontak', ['active', 'nonactive'])->nullable()->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kontak_p_t_s');
    }
};
