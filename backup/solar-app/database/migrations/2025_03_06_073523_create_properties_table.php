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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('region_id')->nullable()->constrained()->onDelete('set null');
            $table->string('postcode');
            $table->string('property_type'); // Detached House, Semi-Detached House, Terraced House, Apartment
            $table->string('roof_type')->nullable(); // Pitched, Flat, etc.
            $table->string('roof_material')->nullable(); // Tile, Metal, etc.
            $table->boolean('has_significant_shading')->default(false);
            $table->decimal('monthly_energy_bill', 10, 2)->nullable();
            $table->integer('annual_energy_usage')->nullable();
            $table->text('additional_details')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
