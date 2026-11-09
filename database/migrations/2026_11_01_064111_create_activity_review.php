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
        Schema::create('activity_review', function (Blueprint $table) {
            $table->id('activity_review_id');
            $table->integer('rating')->min(0)->max(5);
            $table->string('title');
            $table->text('description');
            $table->foreignId('activity_id')->references('activity_id')->on('activity')->cascadeOnDelete();
            $table->foreignId('user_id')->references('user_id')->on('user')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_review');
    }
};
