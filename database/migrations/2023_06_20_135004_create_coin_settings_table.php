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
        Schema::create('coin_settings', function (Blueprint $table) {
            $table->id();
            $table->string('active')->default(0);
            $table->double('value');
            $table->date('date')->nullable();
            $table->enum('type', ['percentage', 'amount'])->nullable();
            $table->timestamps();
        });

        Schema::create('coin_setting_translations', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->string('locale')->nullable();
            $table->foreignId('coin_setting_id');
            $table->foreign('coin_setting_id')->references('id')->on('coin_settings')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coin_settings');
    }
};
