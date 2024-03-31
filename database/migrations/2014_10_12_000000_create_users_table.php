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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id')->references('id')->on('roles');
            $table->unsignedBigInteger('divisi_id');
            $table->foreign('divisi_id')->references('id')->on('divisis');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('nik')->unique();
            $table->string('password');
            $table->string('no_hp');
            $table->string('alamat');
            $table->date('tgl_lahir');
            $table->enum('jk', ['L', 'P']);
            $table->string('file_ktp');
            $table->enum('status_user', ['active', 'nonactive'])->default('active');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
