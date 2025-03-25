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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(false);
            $table->string('code');
            $table->string('ref');
            $table->string('status')->nullable(false);
            $table->timestamp('order_data')->useCurrent();
            $table->decimal('base_total_price', 10, 2)->nullable(false);
            $table->decimal('discount_amount',10, 2)->nullable(true);
            $table->decimal('discount_percent',10, 2)->nullable(true);
            $table->decimal('shipping_cost',10, 2);
            $table->decimal('grand_total',10, 2)->nullable(false);
            $table->text('note')->nullable(true);
            $table->timestamp('deleted_at');

            $table->foreign('user_id')->on('users')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
