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
        Schema::create('business_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable();
            $table->tinyInteger('type')->default(0);

            $table->timestamps();
        });

        Schema::create('business_type_translations', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('locale')->nullable();
            $table->foreignId('business_type_id');
            $table->foreign('business_type_id')->references('id')->on('business_types')->onDelete('cascade');;

            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_types');
        Schema::dropIfExists('business_type_translations');
    }
};
