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
        Schema::create('interest_detail', function (Blueprint $table) {
            $table->id('interest_detail_id');
            $table->foreignId('user_id')->references('user_id')->on('user')->cascadeOnDelete();
            $table->foreignId('interest_id')->references('interest_id')->on('interest')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interest_detail');
    }
};
