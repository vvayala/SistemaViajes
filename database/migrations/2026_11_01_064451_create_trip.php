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
        Schema::create('trip', function (Blueprint $table) {
            $table->id('trip_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('number_of_people');
            $table->string('title');
            $table->text('description');
            $table->foreignId('trip_type_id')->references('trip_type_id')->on('trip_type');
            $table->foreignId('user_id')->references('user_id')->on('user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trip');
    }
};
