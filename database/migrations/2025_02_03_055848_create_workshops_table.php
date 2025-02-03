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
        Schema::create('workshops', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar')->unique();
            $table->string('name_en')->unique();
            $table->longText('description_ar');
            $table->longText('description_en');
            $table->dateTime('start_time'); // Event start time
            $table->dateTime('end_time')->nullable(); // Event end time
            $table->unsignedBigInteger('agenda_id');
            $table->foreign('agenda_id')->references('id')->on('agenda')->onDelete('cascade');
            $table->decimal('lat', 10, 6)->nullable(); // Latitude for location
            $table->decimal('lon', 10, 6)->nullable(); // Longitude for location
            $table->unsignedBigInteger('event_id'); // Reference to the event (foreign key)
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->integer('capacity')->default(0); // Default capacity is 0

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workshops');
    }
};
