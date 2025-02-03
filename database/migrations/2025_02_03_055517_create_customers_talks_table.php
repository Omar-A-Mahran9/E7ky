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
        Schema::create('customers_talks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('talk_id'); // Reference to the talk
            $table->unsignedBigInteger('customer_id'); // Reference to the speaker

            // Foreign key constraints
            $table->foreign('talk_id')->references('id')->on('talks')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');

            // Ensure unique combination of talk and speaker
            $table->unique(['talk_id', 'customer_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers_talks');
    }
};
