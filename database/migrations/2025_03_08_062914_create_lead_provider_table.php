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
        if (! Schema::hasTable('lead_provider')) {
            Schema::create('lead_provider', function (Blueprint $table) {
                $table->id();
                $table->foreignId('lead_id')->constrained()->onDelete('cascade');
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->string('status')->default('assigned'); // assigned, contacted, quoted, converted, rejected
                $table->timestamp('assigned_at')->nullable();
                $table->timestamp('contacted_at')->nullable();
                $table->timestamps();

                // Prevent duplicate entries
                $table->unique(['lead_id', 'user_id']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lead_provider');
    }
};
