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
            $table->string('name'); //legal name
            $table->string('email')->unique();
            $table->string('pnum')->unique();
            $table->string('reference'); //how you got to know about us
            //address
            $table->string('street_address');
            $table->string('suite');
            $table->string('city');
            $table->string('country');
            $table->string('state');
            $table->string('zipcode');
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
