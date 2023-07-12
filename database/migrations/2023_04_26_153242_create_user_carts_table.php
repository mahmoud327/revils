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
        Schema::create('user_carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('product_id');
            $table->integer('quantity');
            $table->tinyInteger('is_ordered')->default(0);
            $table->tinyInteger('order_status')->default(0);
            $table->tinyInteger('shipment_status')->default(0)->comment('shipment_status 0 - Shipping not started, 1 - Shipping started, 2 - order completed, 3 - order cancelled');
            $table->string('awb_no')->nullable();
            $table->string('ref_no')->nullable();
            $table->json('attributes')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_carts');
    }
};
