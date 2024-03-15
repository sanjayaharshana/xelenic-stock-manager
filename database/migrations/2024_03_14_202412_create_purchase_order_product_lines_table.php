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
        Schema::create('purchase_order_product_lines', function (Blueprint $table) {
            $table->id();
            $table->text('purchase_order_id');
            $table->text('product_id');
            $table->text('quantity');
            $table->text('unit_price');
            $table->text('total');
            $table->text('discount');
            $table->text('product_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_order_product_lines');
    }
};
