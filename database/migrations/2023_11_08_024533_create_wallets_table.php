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
        Schema::create('wallets', function (Blueprint $table) {
           
            $table->bigIncrements('id');
            $table->string('icon')->nullable();
            $table->string('money');
            $table->string('name')->nullable();
            $table->integer('status')->nullable();
            $table->unsignedBigInteger('money_type_id');
            $table->foreign('money_type_id')->references('id')->on('wallets');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('tbl_users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallets');
    }
};
