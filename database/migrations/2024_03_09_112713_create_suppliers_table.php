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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->text('supplier_name');
            $table->text('address')->nullable();
            $table->text('contact_number');
            $table->text('email')->nullable();
            $table->text('contact_person')->nullable();
            $table->text('contact_person_number')->nullable();
            $table->text('contact_person_email')->nullable();
            $table->text('contact_person_designation')->nullable();
            $table->text('register_number')->nullable();
            $table->text('vat_number')->nullable();
            $table->text('nic')->nullable();
            $table->text('bank_name')->nullable();
            $table->text('branch')->nullable();
            $table->text('account_number')->nullable();
            $table->text('account_name')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
