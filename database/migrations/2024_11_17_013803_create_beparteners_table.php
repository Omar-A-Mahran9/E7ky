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
        Schema::create('beparteners', function (Blueprint $table) {
            $table->id();
            $table->string('name');
             $table->unsignedBigInteger('brand_id')->nullable();
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->string('year');
 
            $table->string('car_number');
            $table->unsignedBigInteger('color_id')->nullable();
            $table->foreign('color_id')->references('id')->on('skin_colors');
            $table->string('Id_image');
            $table->string('Personal_image');
            $table->string('License_image');
            $table->string('car_paper_image');

            $table->enum('statue', ['active', 'inactive', 'pending'])->default('pending');
            $table->unsignedBigInteger('payment_data_id')->nullable();
            $table->foreign('payment_data_id')->references('id')->on('payment_data');
     



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beparteners');
    }
};
