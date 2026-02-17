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
        // PRODUCTS TABLE
        Schema::table('products', function (Blueprint $table) {
            // Single indexes untuk kolom yang sering di-query
            $table->index('category');      // WHERE category = 'minuman'
            $table->index('price');         // ORDER BY price
            $table->index('created_at');    // ORDER BY created_at (latest)
            $table->index('stock');         // WHERE stock > 0

            // Composite index untuk query kompleks
            // Dipakai saat: WHERE category = X ORDER BY price
            $table->index(['category', 'price']);
        });

        // ORDERS TABLE
        Schema::table('orders', function (Blueprint $table) {
            $table->index('user_id');       // WHERE user_id = X (my orders)
            $table->index('status');        // WHERE status = 'pending'
            $table->index('created_at');    // ORDER BY created_at

            // Composite: WHERE user_id = X AND status = 'pending'
            $table->index(['user_id', 'status']);
        });

        // ORDER_ITEMS TABLE
        Schema::table('order_items', function (Blueprint $table) {
            $table->index('order_id');      // JOIN orders
            $table->index('product_id');    // JOIN products
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex(['category']);
            $table->dropIndex(['price']);
            $table->dropIndex(['created_at']);
            $table->dropIndex(['stock']);
            $table->dropIndex(['category', 'price']);
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
            $table->dropIndex(['status']);
            $table->dropIndex(['created_at']);
            $table->dropIndex(['user_id', 'status']);
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->dropIndex(['order_id']);
            $table->dropIndex(['product_id']);
        });
    }
};
