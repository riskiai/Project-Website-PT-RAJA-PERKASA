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
        Schema::create('list__peralatans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('brand__peralatans_id')->nullable();
            $table->foreign('brand__peralatans_id')->references('id')->on('brand__peralatans');
            $table->unsignedBigInteger('peralatans_id')->nullable();
            $table->foreign('peralatans_id')->references('id')->on('peralatans');
            $table->string('capacity');
            $table->date('tahun_beli_peralatans');
            $table->string('ownership');
            $table->string('tools_certificate');
            $table->date('certificate_expired_date');
            $table->string('certificate_by');
            $table->string('unit_qty');
            $table->enum('status_list_peralatans', ['active', 'nonactive'])->nullable()->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('list__peralatans');
    }
};
