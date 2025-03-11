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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('property_id')->constrained()->onDelete('cascade');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('preferred_contact_method')->default('email'); // email, phone, either
            $table->text('additional_details')->nullable();
            $table->string('status')->default('new'); // new, assigned, contacted, converted, closed
            $table->timestamps();
        });

        // Create a pivot table for lead-service relationships
        Schema::create('lead_service', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lead_id')->constrained()->onDelete('cascade');
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            $table->unique(['lead_id', 'service_id']);
        });

        // Create a pivot table for lead-provider assignments
        Schema::create('lead_provider', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lead_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('status')->default('assigned'); // assigned, contacted, quoted, won, lost
            $table->timestamp('assigned_at')->useCurrent();
            $table->timestamp('contacted_at')->nullable();
            $table->timestamps();
            
            $table->unique(['lead_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lead_provider');
        Schema::dropIfExists('lead_service');
        Schema::dropIfExists('leads');
    }
};
