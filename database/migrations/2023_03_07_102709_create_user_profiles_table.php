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
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index();
            $table->foreignId('country_id');
            $table->string('website')->nullable();
            $table->foreignId('state_id');
            $table->string('zip_code')->nullable();
            $table->string('street1')->nullable();
            $table->string('street2')->nullable();
            $table->string('phone',45)->nullable();
            $table->string('mobile',45);
            $table->tinyInteger('mobile_verified')->default(0);
            $table->string('job_title',100)->nullable();
            $table->smallInteger('family_status')->default(0);
            $table->string('gender')->nullable();
            $table->foreignId('university_id')->default(0);
            $table->foreignId('company_id')->default(0);
            $table->string('ethnicity',45)->nullable();
            $table->string('Nationality',45)->nullable();
            $table->string('language',45)->nullable();
            $table->string('major',45)->nullable();
            $table->string('company_title',45)->nullable();
            $table->string('linkedin')->nullable();
            $table->string('facebook')->nullable();
            $table->string('snapchat')->nullable();
            $table->string('twitter')->nullable();
            $table->string('youtube')->nullable();
            $table->string('instagram')->nullable();
            $table->string('birthplace',45)->nullable();
            $table->longText('bio')->nullable();
            $table->date('birthdate')->nullable();
            $table->foreignId('city_id')->default(0);
            $table->string('displayName',45)->nullable();
            $table->string('otp')->default(0);
            $table->string('otp_date',45);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
