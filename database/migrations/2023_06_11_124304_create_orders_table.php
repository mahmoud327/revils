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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->double('amount')->default(0);
            $table->double('shipping_amount')->default(0);
            $table->string('currency')->nullable();
            $table->text('billing_address')->nullable();
            $table->foreignId('user_address_id')->nullable();
            $table->foreign('user_address_id')->references('id')->on('user_addresses')->onDelete('cascade');


            $table->enum('order_status', ['ordered', 'delivered', 'canceled'])->default('ordered');
            $table->tinyInteger('shipment_status')->default(0)->comment('shipment_status 0 - Shipping not started, 1 - Shipping started, 2 - order completed, 3 - order cancelled');

            $table->foreignId('coupon_id')->nullable();
            $table->foreign('coupon_id')->references('id')->on('coupons')->onDelete('cascade');

            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->foreignId('payment_id')->nullable();
            $table->foreign('payment_id')->references('id')->on('payments')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
