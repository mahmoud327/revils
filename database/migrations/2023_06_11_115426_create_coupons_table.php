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

        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->date('expiry_date')->nullable();
            $table->double('value');
            $table->enum('type', ['percentage', 'amount'])->nullable();
            $table->timestamps();
        });


        Schema::create('coupon_translations', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('locale')->nullable();
            $table->foreignId('coupon_id');
            $table->foreign('coupon_id')->references('id')->on('coupons')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupon');
    }
};
