<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table): void {
            $table->string('tracking_number')->nullable()->after('shipping_method');
            $table->timestamp('cancel_requested_at')->nullable()->after('tracking_number');
            $table->timestamp('returned_at')->nullable()->after('cancel_requested_at');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table): void {
            $table->dropColumn(['tracking_number', 'cancel_requested_at', 'returned_at']);
        });
    }
};
