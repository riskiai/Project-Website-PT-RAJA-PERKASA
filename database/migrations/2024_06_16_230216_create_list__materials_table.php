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
        Schema::create('list__materials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('brand__materials_id')->nullable();
            $table->foreign('brand__materials_id')->references('id')->on('brand__materials');
            $table->unsignedBigInteger('materials_id')->nullable();
            $table->foreign('materials_id')->references('id')->on('materials');
            $table->string('countries');
            $table->string('tkdn');
            $table->string('tknd_certificate');
            $table->date('expired_materials_date');
            $table->enum('status_list_materials', ['active', 'nonactive'])->nullable()->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('list__materials');
    }
};
