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
        Schema::create('reservation', function (Blueprint $table) {
            $table->id('reservation_id');
            $table->string('name');
            $table->decimal('price',8,2);
            $table->integer('quantity');
            $table->text('description');
            $table->foreignId('trip_id')->references('trip_id')->on('trip')->constrained();
            $table->foreignId('reservation_type_id')->references('reservation_type_id')->on('reservation_type');
            $table->foreignId('activity_id')->nullable()->constrained('activity', 'activity_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation');
    }
};
