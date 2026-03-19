<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            $table->string('phone')->nullable()->after('email');
            $table->string('profile_photo_path')->nullable()->after('password');
            $table->string('default_payment_method')->nullable()->after('profile_photo_path');
            $table->string('preferred_shipping_method')->nullable()->after('default_payment_method');
        });

        Schema::table('products', function (Blueprint $table): void {
            $table->string('sku')->nullable()->unique()->after('slug');
            $table->unsignedInteger('low_stock_threshold')->default(5)->after('stock');
        });

        Schema::table('orders', function (Blueprint $table): void {
            $table->string('invoice_number')->nullable()->unique()->after('order_number');
            $table->string('payment_method')->nullable()->after('payment_status');
            $table->string('payment_reference')->nullable()->after('payment_method');
            $table->string('shipping_method')->nullable()->after('payment_reference');
            $table->decimal('tax_rate', 5, 2)->default(0)->after('tax');
            $table->timestamp('invoice_generated_at')->nullable()->after('notes');
        });

        Schema::create('stock_movements', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->foreignId('order_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('admin_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('type');
            $table->integer('quantity_change');
            $table->unsignedInteger('stock_before');
            $table->unsignedInteger('stock_after');
            $table->string('reference')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_movements');

        Schema::table('orders', function (Blueprint $table): void {
            $table->dropColumn([
                'invoice_number',
                'payment_method',
                'payment_reference',
                'shipping_method',
                'tax_rate',
                'invoice_generated_at',
            ]);
        });

        Schema::table('products', function (Blueprint $table): void {
            $table->dropUnique(['sku']);
            $table->dropColumn(['sku', 'low_stock_threshold']);
        });

        Schema::table('users', function (Blueprint $table): void {
            $table->dropColumn([
                'phone',
                'profile_photo_path',
                'default_payment_method',
                'preferred_shipping_method',
            ]);
        });
    }
};
