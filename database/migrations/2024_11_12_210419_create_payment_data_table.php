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
        Schema::create('payment_data', function (Blueprint $table) {
            $table->id();

            // User and payment details
            $table->decimal('amount', 10, 2)->nullable(); // Payment amount
            $table->string('payment_method')->nullable(); // Payment method (e.g., Credit Card, PayPal)
            $table->string('payment_status')->nullable(); // Payment status (e.g., Pending, Completed)
            $table->string('transaction_id')->unique()->nullable(); // Unique transaction ID
            $table->timestamp('payment_date')->nullable(); // Date of payment

            // Card details
            $table->string('card_number')->nullable(); // Card number
            $table->string('security_code')->nullable(); // Card security code (CVV)
            $table->string('first_name')->nullable(); // Cardholder's first name
            $table->string('last_name')->nullable(); // Cardholder's last name


            $table->string('bank_owner_name')->nullable();
            $table->longText('iban_number')->unique()->nullable();
            $table->longText('address')->nullable();
            $table->longText('BIC/Swift')->unique()->nullable();
            
            // Timestamps for created_at and updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_data');
    }
};
