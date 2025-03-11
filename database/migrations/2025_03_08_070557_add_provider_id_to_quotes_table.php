<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First add the column
        Schema::table('quotes', function (Blueprint $table) {
            if (!Schema::hasColumn('quotes', 'provider_id')) {
                $table->foreignId('provider_id')->nullable()->after('user_id');
            }
        });
        
        // Then update the data
        DB::statement('UPDATE quotes SET provider_id = user_id WHERE provider_id IS NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quotes', function (Blueprint $table) {
            $table->dropColumn('provider_id');
        });
    }
};
