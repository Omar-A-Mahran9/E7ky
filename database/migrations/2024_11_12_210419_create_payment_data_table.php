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
             $table->decimal('amount', 10, 2); // Payment amount
            $table->string('payment_method'); // Payment method (e.g., Credit Card, PayPal)
            $table->string('payment_status'); // Payment status (e.g., Pending, Completed)
            $table->string('transaction_id')->unique(); // Unique transaction ID
            $table->timestamp('payment_date'); // Date of payment

            // Card details
            $table->string('card_number'); // Card number
            $table->string('security_code'); // Card security code (CVV)
            $table->string('first_name'); // Cardholder's first name
            $table->string('last_name'); // Cardholder's last name

            // Optional: If the payment is related to an order
            $table->unsignedBigInteger('booking_id')->nullable(); // Foreign key to orders table, if applicable
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('set null');

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
