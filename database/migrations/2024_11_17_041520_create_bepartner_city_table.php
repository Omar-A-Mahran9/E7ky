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
        Schema::create('bepartner_city', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bepartener_id'); // Foreign key to bepartners table
            $table->unsignedBigInteger('city_id'); // Foreign key to cities table
        
            // Foreign key constraints
            $table->foreign('bepartener_id')->references('id')->on('beparteners')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bepartner_city');
    }
};
