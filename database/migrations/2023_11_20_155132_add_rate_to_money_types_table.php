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
        Schema::table('moneytypes', function (Blueprint $table) {
            $table->decimal('rate', 10, 5)->default(1.00000)->after('name');
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('moneytypes', function (Blueprint $table) {
            $table->dropColumn('rate');
            //
        });
    }
};
