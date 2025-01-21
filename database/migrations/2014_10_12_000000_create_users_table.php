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
            $table->string('login')->nullable();
            $table->string('email')->unique();
            $table->string('region')->nullable();
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->string('thirdname')->nullable();
            $table->date('birth_dt')->nullable();
            $table->string('telegram')->nullable();
            $table->string('type_of_activity')->nullable();
            $table->string('eco_part')->nullable();
            $table->string('workplace')->nullable();
            $table->string('volunteer_experience')->nullable();
            $table->string('telephone')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
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
