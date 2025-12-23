<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Simplify contacts table to match PDF form requirements:
     * - Keep: name, company, email, phone, location, inquiry_types, notes, consent_agreed
     * - Remove: subject, message, ev_products, charging_products, intended_use, budget, timeline fields
     */
    public function up(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            // Drop columns that are not in the PDF form
            $table->dropColumn([
                'subject',
                'message',
                'ev_products',
                'ev_products_other',
                'charging_products',
                'charging_products_other',
                'intended_use',
                'intended_use_other',
                'estimated_budget',
                'purchase_timeline'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            // Restore removed columns
            $table->string('subject')->nullable()->after('phone');
            $table->text('message')->nullable()->after('subject');
            $table->json('ev_products')->nullable()->after('inquiry_types');
            $table->string('ev_products_other')->nullable()->after('ev_products');
            $table->json('charging_products')->nullable()->after('ev_products_other');
            $table->string('charging_products_other')->nullable()->after('charging_products');
            $table->string('intended_use')->nullable()->after('charging_products_other');
            $table->string('intended_use_other')->nullable()->after('intended_use');
            $table->string('estimated_budget')->nullable()->after('intended_use_other');
            $table->string('purchase_timeline')->nullable()->after('estimated_budget');
        });
    }
};
