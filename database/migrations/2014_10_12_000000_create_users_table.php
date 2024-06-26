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
            $table->unsignedBigInteger('divisi_id')->nullable();
            $table->foreign('divisi_id')->references('id')->on('divisis')->nullable();
            $table->unsignedBigInteger('mitra_id')->nullable();
            $table->foreign('mitra_id')->references('id')->on('mitras')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('nik')->unique()->nullable();
            $table->string('password');
            $table->string('no_hp')->nullable();
            $table->string('alamat')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->enum('jk', ['L', 'P'])->nullable();
            $table->string('file_foto')->nullable();
            $table->string('file_ktp')->nullable();
            $table->enum('status_pic_perusahaan', ['calon_client', 'client'])->nullable()->default('calon_client');
            $table->enum('status_user', ['active', 'nonactive'])->nullable()->default('active');
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
