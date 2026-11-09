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
        Schema::create('forum_participation', function (Blueprint $table) {
            $table->id('forum_participation_id');
            $table->foreignId('forum_id')->references('forum_id')->on('forum')->cascadeOnDelete();
            $table->foreignId('user_id')->references('user_id')->on('user');
            $table->text('comment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forum_participation');
    }
};
