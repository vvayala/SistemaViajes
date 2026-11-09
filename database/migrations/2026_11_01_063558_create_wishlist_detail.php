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
        Schema::create('wishlist_detail', function (Blueprint $table) {
            $table->id('wishlist_detail_id');
            $table->foreignId('wishlist_id')->references('wishlist_id')->on('wishlist')->cascadeOnDelete();
            $table->foreignId('activity_id')->references('activity_id')->on('activity')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wishlist_detail');
    }
};
