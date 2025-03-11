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
        Schema::table('users', function (Blueprint $table) {
            // Add missing columns
            if (!Schema::hasColumn('users', 'contact_name')) {
                $table->string('contact_name')->nullable();
            }
            
            if (!Schema::hasColumn('users', 'website')) {
                $table->string('website')->nullable();
            }
            
            if (!Schema::hasColumn('users', 'certifications')) {
                $table->text('certifications')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['contact_name', 'website', 'certifications']);
        });
    }
};
