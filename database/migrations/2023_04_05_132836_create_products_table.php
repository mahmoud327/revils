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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('category_id');
            $table->string('item_type');
            $table->integer('weight')->nullable();
            $table->double('price');
            $table->double('old_price')->nullable();
            $table->double('quantity');
            $table->string('unit')->nullable();
            $table->integer('view_number')->default(0);
            $table->tinyInteger('status')->default(0)->comment('0 pending, 1 approved, 2 rejected');
            $table->string('reason')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->tinyInteger('is_free_shipping')->default(0);
            $table->bigInteger('cash')->nullable();
            $table->tinyInteger('is_batteries_shipping')->default(0);
            $table->tinyInteger('is_dangerous_shipping')->default(0);
            $table->tinyInteger('is_liquid_shipping')->default(0);
            $table->tinyInteger('is_handcrafted')->default(0);
            $table->tinyInteger('check_coin')->default(0);
            $table->json('name')->nullable();
            $table->json('description')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
