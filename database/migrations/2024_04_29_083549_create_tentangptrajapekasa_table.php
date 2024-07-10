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
        Schema::create('tentangptrajapekasa', function (Blueprint $table) {
            $table->id();
            // $table->string('title');
            $table->text('short_description');
            $table->text('detail_description');
            $table->enum('status_tentang', ['active', 'nonactive'])->nullable()->default('active');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tentangptrajapekasa');
    }
};
