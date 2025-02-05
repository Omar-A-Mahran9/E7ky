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
        Schema::create('customers_workshops', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('workshop_id'); // Reference to the talk
            $table->unsignedBigInteger('customer_id'); // Reference to the speaker

            // Foreign key constraints
            $table->foreign('workshop_id')->references('id')->on('workshops')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');

            // Ensure unique combination of talk and speaker
            $table->unique(['workshop_id', 'customer_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('talks_workshops');
    }
};
