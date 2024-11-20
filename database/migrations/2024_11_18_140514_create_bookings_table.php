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

            $table->unsignedBigInteger('car_prices_id')->nullable();
            $table->foreign('car_prices_id')->references('id')->on('car_prices');
            
            $table->unsignedBigInteger('package_id')->nullable();
            $table->foreign('package_id')->references('id')->on('packages');
                   
            $table->unsignedBigInteger('addon_services_id')->nullable();
            $table->foreign('addon_services_id')->references('id')->on('addon_services');
            
            $table->unsignedBigInteger('payment_data_id')->nullable();
            $table->foreign('payment_data_id')->references('id')->on('payment_data');
            
            $table->boolean('go_only')->default(0);
            $table->boolean('go_and_return')->default(0);
           
            $table->string('ticket_image')->nullable();



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
