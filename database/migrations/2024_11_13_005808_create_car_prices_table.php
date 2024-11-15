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
        Schema::create('car_prices', function (Blueprint $table) {
            $table->id();
            $table->enum('type',['per_hour','per_trip']);
            $table->unsignedBigInteger('car_id')->nullable();
            $table->foreign('car_id')->references('id')->on('cars');
       
            $table->string('price');

            $table->unsignedBigInteger('city')->nullable();
            $table->foreign('city')->references('id')->on('cities');
            
            $table->unsignedBigInteger('from')->nullable();
            $table->foreign('from')->references('id')->on('cities');
            
            $table->unsignedBigInteger('to')->nullable();
            $table->foreign('to')->references('id')->on('cities');
            $table->boolean('statue')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_prices');
    }
};
