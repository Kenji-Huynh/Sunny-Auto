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
            // Thêm lại trường subject và message
            // Đặt sau phone để giữ thứ tự logic
            $table->string('subject')->nullable()->after('phone');
            $table->text('message')->nullable()->after('subject');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            // Xóa nếu rollback
            $table->dropColumn(['subject', 'message']);
        });
    }
};
