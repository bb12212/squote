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
            $table->string('last_name')->nullable()->after('name');
            $table->string('phone')->nullable()->after('email');
            $table->string('role')->default('consumer')->after('phone'); // consumer, provider, admin
            $table->string('preferred_contact_method')->default('email')->after('role'); // email, phone, either
            $table->foreignId('region_id')->nullable()->after('preferred_contact_method');
            $table->text('company_name')->nullable()->after('region_id');
            $table->text('company_description')->nullable()->after('company_name');
            $table->text('services_offered')->nullable()->after('company_description');
            $table->text('certifications')->nullable()->after('services_offered');
            $table->boolean('is_approved')->default(false)->after('certifications');
            $table->string('subscription_status')->nullable()->after('is_approved');
            $table->timestamp('subscription_ends_at')->nullable()->after('subscription_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'last_name',
                'phone',
                'role',
                'preferred_contact_method',
                'region_id',
                'company_name',
                'company_description',
                'services_offered',
                'certifications',
                'is_approved',
                'subscription_status',
                'subscription_ends_at',
            ]);
        });
    }
};
