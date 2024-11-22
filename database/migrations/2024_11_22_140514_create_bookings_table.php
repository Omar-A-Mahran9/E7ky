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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['per_trip', 'per_hour', 'per_package','booking_start'])->default('per_trip');
    //Book per_trip and per_hour
            $table->unsignedBigInteger('car_prices_id')->nullable();
            $table->foreign('car_prices_id')->references('id')->on('car_prices');
            
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id')->references('id')->on('customers');
          //addon multi

            $table->unsignedBigInteger('package_id')->nullable();
            $table->foreign('package_id')->references('id')->on('packages');
                   
                // User and payment details
            $table->unsignedBigInteger('payment_way_id')->nullable();
            $table->foreign('payment_way_id')->references('id')->on('payment_ways');
       
            $table->unsignedBigInteger('payment_method_id')->nullable();
            $table->foreign('payment_method_id')->references('id')->on('payment_methods');
                
            $table->unsignedBigInteger('payment_data_id')->nullable();
            $table->foreign('payment_data_id')->references('id')->on('payment_data');
            
            $table->boolean('go_only')->default(0);
            $table->boolean('go_and_return')->default(0);
           
            $table->string('ticket_image')->nullable();
          
            $table->longText('notes')->nullable();

            $table->enum('status', ['pending', 'progress','payed', 'complete', 'accept', 'reject'])->default('pending');

            $table->time('from_time')->nullable(); // Time type for from_time
            $table->time('to_time')->nullable(); // Time type for to_time
            $table->string('time')->nullable(); // String type for time
            $table->date('date')->nullable(); // Date type for date
            $table->integer('time_count')->nullable(); // Integer type for time_count
            $table->decimal('amount', 10, 2)->nullable(); // Payment amount
            $table->decimal('discount', 10, 2)->nullable(); // Payment amount
            $table->decimal('total', 10, 2)->nullable(); // Payment amount


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
