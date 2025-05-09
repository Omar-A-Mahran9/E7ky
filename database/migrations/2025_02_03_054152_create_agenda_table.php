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
        Schema::create('agenda', function (Blueprint $table) {
            $table->id();

            $table->string('name_ar')->unique();
            $table->string('name_en')->unique();
            $table->longText('description_ar')->nullable();
            $table->longText('description_en')->nullable();
            $table->date("start_day");
            $table->date("end_day")->nullable();
            $table->unsignedBigInteger('event_id'); // Reference to the event (foreign key)
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agenda');
    }
};
