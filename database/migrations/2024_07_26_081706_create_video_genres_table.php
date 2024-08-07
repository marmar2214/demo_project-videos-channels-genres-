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
        if (!Schema::hasTable('video_genres')) {
            Schema::create('video_genres', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('video_id');
                $table->unsignedBigInteger('genre_id');
                $table->foreign('video_id')->references('id')->on('videos')->onDelete('cascade');
                $table->foreign('genre_id')->references('id')->on('genres')->onDelete('cascade');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('genre_video');
        if (Schema::hasTable('video_genres')) {
            Schema::dropIfExists('video_genres');
        }
    }
};
