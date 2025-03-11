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
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lead_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Provider ID
            $table->decimal('total_amount', 10, 2);
            $table->text('description');
            $table->text('system_details')->nullable();
            $table->integer('system_size_kw')->nullable();
            $table->integer('estimated_annual_production_kwh')->nullable();
            $table->decimal('estimated_savings_per_year', 10, 2)->nullable();
            $table->integer('warranty_years')->nullable();
            $table->date('valid_until');
            $table->string('status')->default('pending'); // pending, accepted, rejected, expired
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotes');
    }
};
