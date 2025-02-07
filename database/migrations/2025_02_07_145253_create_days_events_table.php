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
        Schema::create('days_events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('day_id');
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('agenda_id');

            // Foreign Keys
            $table->foreign('day_id')->references('id')->on('days')->onDelete('cascade');
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->foreign('agenda_id')->references('id')->on('agenda')->onDelete('cascade');

            // Unique constraint on (day_id, event_id, agenda_id)
            $table->unique(['day_id', 'event_id', 'agenda_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('days_events');
    }
};
