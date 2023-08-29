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
        Schema::create('user_coin_earns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->default(0);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('coin_id')->default(0);
            $table->foreign('coin_id')->references('id')->on('coin_settings')->onDelete('cascade');

            $table->bigInteger('value')->default(0);
            $table->date('date')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_coin_earns');
    }
};
