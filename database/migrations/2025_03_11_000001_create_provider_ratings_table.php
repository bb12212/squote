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
        Schema::create('provider_ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('provider_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('consumer_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('quote_id')->nullable()->constrained('quotes')->onDelete('set null');
            $table->integer('rating')->comment('Rating from 1-5');
            $table->text('review')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->timestamps();

            // Ensure one rating per provider-consumer-quote combination
            $table->unique(['provider_id', 'consumer_id', 'quote_id'], 'unique_rating');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('provider_ratings');
    }
};
