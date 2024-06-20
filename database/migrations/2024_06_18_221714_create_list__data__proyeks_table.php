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
        Schema::create('list__data__proyeks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('materials_id')->nullable();
            $table->foreign('materials_id')->references('id')->on('materials');
            $table->unsignedBigInteger('brand__materials_id')->nullable();
            $table->foreign('brand__materials_id')->references('id')->on('brand__materials');
            $table->unsignedBigInteger('peralatans_id')->nullable();
            $table->foreign('peralatans_id')->references('id')->on('peralatans');
            $table->unsignedBigInteger('brand__peralatans_id')->nullable();
            $table->foreign('brand__peralatans_id')->references('id')->on('brand__peralatans');
            $table->string('title_proyek')->nullable();
            $table->string('project_name')->nullable();
            $table->string('client_name')->nullable();
            $table->string('main_contractor')->nullable();
            $table->string('scope')->nullable();
            $table->date('start_date_proyek')->nullable();
            $table->date('end_date_proyek')->nullable();
            $table->string('value')->nullable();
            $table->string('handover')->nullable();
            $table->string('po')->nullable();
            $table->text('image')->nullable();
            $table->enum('status_progres_proyek', ['sedangberjalan', 'selesai'])->nullable()->default('sedangberjalan');
            $table->enum('status_proyek', ['disetujui', 'tidak_disetujui', 'belumdicek'])->nullable()->default('belumdicek');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('list__data__proyeks');
    }
};
