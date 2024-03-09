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
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->text('supplier_id');
            $table->text('grand_total');
            $table->enum('status', ['Pending', 'Approved', 'Rejected']);
            $table->text('created_by');
            $table->enum('payment_terms', ['Cash', 'Credit']);
            $table->timestamp('delivery_date')->nullable();
            $table->text('remarks')->nullable();
            $table->text('approved_by')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->text('rejected_by')->nullable();
            $table->timestamp('rejected_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
};
