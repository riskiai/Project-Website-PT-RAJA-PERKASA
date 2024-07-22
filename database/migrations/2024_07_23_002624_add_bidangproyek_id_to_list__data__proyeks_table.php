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
            $table->foreign('bidangproyek_id')->references('id')->on('bidang_proyeks');
            $table->unsignedBigInteger('bidangproyek_id')->nullable()->after('id');
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
