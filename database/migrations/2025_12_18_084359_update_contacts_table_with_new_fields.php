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
        Schema::table('contacts', function (Blueprint $table) {
            // Remove old fields
            $table->dropColumn(['subject', 'message']);
            
            // Add new contact information fields
            $table->string('company')->nullable()->after('name');
            $table->string('location')->nullable()->after('email');
            
            // Inquiry type (stored as JSON array)
            $table->json('inquiry_types')->nullable()->after('location');
            
            // Products of interest
            $table->json('ev_products')->nullable()->after('inquiry_types');
            $table->string('ev_products_other')->nullable()->after('ev_products');
            $table->json('charging_products')->nullable()->after('ev_products_other');
            $table->string('charging_products_other')->nullable()->after('charging_products');
            
            // Intended use
            $table->string('intended_use')->nullable()->after('charging_products_other');
            $table->string('intended_use_other')->nullable()->after('intended_use');
            
            // Purchase plan
            $table->string('estimated_budget')->nullable()->after('intended_use_other');
            $table->string('purchase_timeline')->nullable()->after('estimated_budget');
            
            // Additional notes
            $table->text('notes')->nullable()->after('purchase_timeline');
            
            // Consent
            $table->boolean('consent_agreed')->default(false)->after('notes');
            
            // Update status enum
            $table->string('status')->default('new')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            // Restore old fields
            $table->string('subject')->after('phone');
            $table->text('message')->after('subject');
            
            // Drop new fields
            $table->dropColumn([
                'company',
                'location',
                'inquiry_types',
                'ev_products',
                'ev_products_other',
                'charging_products',
                'charging_products_other',
                'intended_use',
                'intended_use_other',
                'estimated_budget',
                'purchase_timeline',
                'notes',
                'consent_agreed'
            ]);
        });
    }
};
