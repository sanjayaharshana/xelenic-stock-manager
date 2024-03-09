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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->text('name')->comment('product name');
            $table->text('sku')->nullable()->comment('product sku');
            $table->text('barcode')->nullable()->comment('product barcode');
            $table->text('description')->nullable()->comment('product description');
            $table->text('unit');
            $table->enum('status', ['active', 'inactive'])->default('active')->comment('product status');
            $table->decimal('list_price')->comment('default product selling price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
