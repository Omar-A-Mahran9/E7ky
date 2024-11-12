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
        Schema::create('products', function (Blueprint $table) {
            $table->id();


            $table->unsignedBigInteger('vendor_id')->nullable();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->unsignedBigInteger('design_type_id'); // Should match the referenced column type


            $table->string('name_ar')->unique();
            $table->string('name_en')->unique();
            $table->string('description_ar');
            $table->string('description_en');
            $table->integer('caliber')->nullable();
            $table->string('design_type')->nullable();
            // $table->double('size');
            // $table->double('weight');
            $table->string('video_link');
            $table->string('maintenance_and_care')->nullable();
            $table->string('packaging')->nullable();
            $table->string('sustainable_assets')->nullable();
            $table->string('main_stone')->nullable();
            $table->string('guarantee')->nullable();
            $table->string('color')->nullable();
            // $table->double('price');
            // $table->double('discount_price')->nullable();
            // $table->date('discount_from')->nullable();
            // $table->date('discount_to')->nullable();
            $table->enum('type', ['Used', 'New']);
            $table->enum('status', ['In Stock', 'Out Stock']);
            $table->string('rejection_reason')->nullable();
            $table->string('meta_tag_key_words')->nullable();
            $table->string('meta_tag_key_description')->nullable();
            $table->foreign('vendor_id')->references('id')->on('vendors');
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->foreign('design_type_id')->references('id')->on('design_types');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
