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
        Schema::table('pengundurandiris', function (Blueprint $table) {
            $table->string('file_balasan')->nullable()->after('file_pengunduran_diri');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengundurandiris', function (Blueprint $table) {
            //
        });
    }
};
