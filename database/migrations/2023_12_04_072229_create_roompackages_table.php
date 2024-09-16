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
        Schema::create('roompackages', function (Blueprint $table) {
            $table->id();
            $table->string('booking_id'); //Booking ID of the package
            $table->string('event_id'); //event for which the package is booked
            $table->string('company_id'); //company that is hosting the event
            $table->string('package_id') -> unique();
            $table->string('package_name');
            $table->string('ppa'); //price per adult
            $table->string('ppa_extended'); //price per adult extended
            $table->string('max_adults'); //Max No. of Adults Allowed
            $table->string('pptgr'); //price per teenager
            $table->string('pptgr_extended'); //price per teenager extended
            $table->string('max_teenagers');
            $table->string('ppchild'); //price per children / infants
            $table->string('ppchild_extended'); //price per children / infants extended
            $table->string('max_children');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roompackages');
    }
};
