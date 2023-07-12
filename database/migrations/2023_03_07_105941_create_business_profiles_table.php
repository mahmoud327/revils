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
        Schema::create('business_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index();
            $table->integer('business_type_id')->default(6);
            $table->integer('business_subtype')->default(1);
            $table->string('display_name')->nullable();
            $table->string('website')->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile', 45);
            $table->string('email', 45)->nullable();
            $table->longText('email2')->nullable();
            $table->string('lang', 15)->nullable();
            $table->string('zipcode')->nullable();
            $table->string('street')->nullable();
            $table->string('street2')->nullable();
            $table->foreignId('country_id')->default(0);
            $table->foreignId('state_id')->default(0);
            $table->foreignId('city_id')->default(0);
            $table->longText('bio')->nullable();
            $table->integer('sponsored_by')->default(0);
            $table->integer('maroof')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_profiles');
    }
};
