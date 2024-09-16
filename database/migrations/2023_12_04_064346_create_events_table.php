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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('event_id');
            $table->string('company_id');
            $table->string('event_name');
            $table->string('event_type'); // single or group
            $table->string('event_date');
            $table->string('event_time_from');
            $table->string('event_time_to');
            $table->string('event_about');
            //$table->string('event_about');
            $table->string('event_city');
            $table->string('event_address');
            $table->string('event_maplink');
            $table->string('max_guest');
            //event page details
            $table->string('event_page_name') -> nullable();
            $table->string('event_page_about') -> nullable();
            $table->string('event_logo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
