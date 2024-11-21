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
        Schema::table('peralatans', function (Blueprint $table) {
            $table->integer('qty')->default(0)->after('status_peralatans'); // Menambahkan kolom qty
        });

        Schema::table('materials', function (Blueprint $table) {
            $table->integer('qty')->default(0)->after('status_materials'); // Menambahkan kolom qty
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peralatans', function (Blueprint $table) {
            $table->dropColumn('qty');
        });

        Schema::table('materials', function (Blueprint $table) {
            $table->dropColumn('qty');
        });
    }
};
