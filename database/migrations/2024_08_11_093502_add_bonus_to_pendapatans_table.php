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
        Schema::table('pendapatans', function (Blueprint $table) {
            $table->decimal('bonus', 15, 2)->after('total');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendapatans', function (Blueprint $table) {
            $table->dropColumn('bonus');
        });
    }
};
