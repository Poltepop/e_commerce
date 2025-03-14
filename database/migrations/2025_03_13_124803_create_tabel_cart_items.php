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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->nullable(false);
            $table->unsignedBigInteger('cart_id')->nullable(false);
            $table->unique(['product_id', 'cart_id']);
            $table->json('variant')->nullable(true);
            $table->integer('qty')->nullable(false)->default(1);

            $table->foreign('product_id')->on('products')->references('id');
            $table->foreign('cart_id')->on('carts')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
