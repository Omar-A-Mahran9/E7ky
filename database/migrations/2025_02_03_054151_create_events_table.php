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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('event_map');

            $table->string('name_ar')->unique();
            $table->string('name_en')->unique();
            $table->longText('description_ar');
            $table->longText('description_en');
            $table->boolean('is_multi_day')->default(false); // Check if it's a multi-day event
            $table->date("start_day");
            $table->date("end_day")->nullable();

            $table->dateTime('start_time'); // Event start time
            $table->dateTime('end_time')->nullable(); // Event end time

            $table->dateTime('registration_start_time')->nullable(); // Start time for registration
            $table->dateTime('registration_end_time')->nullable(); // End time for registration

            $table->decimal('lat', 10, 6)->nullable(); // Latitude for location
            $table->decimal('lon', 10, 6)->nullable(); // Longitude for location
            $table->integer('capacity')->nullable(); // Max attendees
            $table->enum('status', ['scheduled', 'ongoing', 'completed', 'canceled'])->default('scheduled'); // Event status
            $table->decimal('price', 10, 2)->nullable(); // Event price
            $table->string('event_link')->nullable(); // External link for the event
            $table->string('streaming_link')->nullable(); // External link for the event
            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
