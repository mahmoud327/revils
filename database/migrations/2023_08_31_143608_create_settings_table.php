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
             //phone


        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('email')->nullable();
            $table->json('about_us')->nullable();
            $table->string('phone')->nullable();
            $table->double('vat')->nullable();
            $table->double('shiping_price')->nullable();
            $table->text('address')->nullable();
            $table->text('fb_link')->nullable();
            $table->text('tw_link')->nullable();
            $table->text('linkedin_link')->nullable();
            $table->text('inst_link')->nullable();
            $table->json('terms_condition')->nullable();
            $table->string('whatsapp')->nullable();
            $table->text('skype_link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
