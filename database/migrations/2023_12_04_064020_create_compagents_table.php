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
        Schema::create('compagents', function (Blueprint $table) {
            $table->id();
            $table->string('agent_id')->unique();
            $table->string('company_id');
            $table->string('name');
            $table->string('email');
            $table->string('role'); //Editor or administrator
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compagents');
    }
};
