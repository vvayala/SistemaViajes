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
        Schema::create('activity', function (Blueprint $table) {
            $table->id('activity_id');
            $table->string('name');
            $table->string('description');
            $table->foreignId('location_id')->references('location_id')->on('location')->nullable();
            $table->foreignId('budget_type_id')->references('budget_type_id')->on('budget_type');
            $table->foreignId('trip_type_id')->references('trip_type_id')->on('trip_type');
            $table->foreignId('interest_id')->references('interest_id')->on('interest');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity');
    }
};
