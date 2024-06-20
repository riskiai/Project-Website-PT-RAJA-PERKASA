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
        Schema::table('list__data__proyeks', function (Blueprint $table) {
            $table->text('keterangan_status_proyek')->nullable()->after('status_proyek');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('list__data__proyeks', function (Blueprint $table) {
            //
        });
    }
};
