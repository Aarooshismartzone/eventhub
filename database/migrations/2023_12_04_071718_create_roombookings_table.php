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
        Schema::create('roombookings', function (Blueprint $table) {
            $table->id();
            $table->string('event_id');
            $table->string('company_id');
            $table->string('booking_id');
            $table->string('venue_name'); // hotel or venue name
            $table->string('available_rooms'); //Number of rooms available
            $table->string('last_deposit_date'); //last date of deposit
            $table->string('dep_amount'); //deposit amount
            $table->string('insurance_amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roombookings');
    }
};
