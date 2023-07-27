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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('username', 100)->unique()->index();
            $table->string('name', 100)->unique()->nullable();
            $table->string('email')->unique()->index();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('mobile',15)->unique()->index();
            $table->timestamp('mobile_verified_at')->nullable();
            $table->string('password');
            $table->tinyInteger('banned')->default(0);
            $table->string('ban_reason')->nullable();
            $table->string('newpass', 34)->nullable();
            $table->string('newpass_key', 32)->nullable();
            $table->date('newpass_time')->nullable();
            $table->string('last_ip')->default('0.0.0.0');
            $table->date('last_login')->nullable();
            $table->tinyInteger('account_type')->default(0);
            $table->string('oauth_provider')->nullable();
            $table->string('oauth_uid')->nullable();
            $table->tinyInteger('is_logged_in')->default(0);
            $table->integer('views')->nullable();
            $table->integer('group_id')->default(0);
            $table->tinyInteger('deactivate')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
