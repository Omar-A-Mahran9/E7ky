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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar')->unique();
            $table->string('name_en')->unique();
            $table->string('price');

            $table->string('image')->unique();
            $table->unsignedBigInteger('package_categories_id')->nullable();
            $table->foreign('package_categories_id')->references('id')->on('package_categories');
            // Cities table relations

            $table->unsignedBigInteger('car_id')->nullable();
            $table->foreign('car_id')->references('id')->on('cars');
          
            $table->unsignedBigInteger('from')->nullable();
            $table->foreign('from')->references('id')->on('cities');
            
            $table->unsignedBigInteger('to')->nullable();
            $table->foreign('to')->references('id')->on('cities');

            $table->date('from_time');
            $table->date('to_time');

            $table->boolean('statue');





            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
