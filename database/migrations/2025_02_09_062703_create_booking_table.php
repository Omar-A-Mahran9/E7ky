<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('booking', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id')->nullable(); // Reference to the event (foreign key)
            $table->unsignedBigInteger('talk_id')->nullable(); // Reference to the talk (foreign key)
            $table->unsignedBigInteger('workshop_id')->nullable(); // Reference to the workshop (foreign key)
            $table->unsignedBigInteger('customer_id'); // Reference to the customer (foreign key)
            $table->unsignedBigInteger('meal_id')->nullable();
            ; // Ensure this column is added first

            $table->integer('quantity')->default(1); // Number of bookings or tickets
            $table->enum('status', ['pending', 'confirmed', 'cancelled', 'completed'])->default('pending'); // Booking status
            $table->enum('type', ['workshop', 'talk', 'event'])->default('event'); // Type of booking
            $table->string('ticket_id')->unique()->nullable(); // Unique ticket ID for QR generation

            $table->dateTime('booked_at')->default(now()); // Time when the booking was made
            $table->dateTime('event_date')->nullable(); // Event date for better tracking
            $table->decimal('price', 10, 2)->nullable(); // Price for the booking
            $table->string('booking_reference')->nullable()->unique(); // Unique booking reference for identification


            $table->foreign('event_id')->references('id')->on('events')->onDelete('set null');
            $table->foreign('talk_id')->references('id')->on('talks')->onDelete('set null');
            $table->foreign('workshop_id')->references('id')->on('workshops')->onDelete('set null');
            $table->foreign('meal_id')->references('id')->on('meals')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking');
    }
};
