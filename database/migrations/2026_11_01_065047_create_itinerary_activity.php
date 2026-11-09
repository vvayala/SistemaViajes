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
        Schema::create('itinerary_activity', function (Blueprint $table) {
            $table->id('itinerary_activity_id');
            $table->foreignId('activity_id')->references('activity_id')->on('activity')->cascadeOnDelete();
            $table->foreignId('itinerary_id')->references('itinerary_id')->on('itinerary')->cascadeOnDelete();
            $table->datetime('start_time');
            $table->datetime('end_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itinerary_activity');
    }
};
