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
        Schema::create('articles_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar', 255);
            $table->string('name_en', 255);

            // ✅ Add missing fields
            $table->string('description_ar', 255)->nullable();
            $table->string('description_en', 255)->nullable();

            $table->integer('status');
            $table->text('image');
            $table->string('img_for_mob', 255);
            $table->string('slug')->nullable();
            $table->integer('sort')->default(0);
            $table->text('html')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords', 255)->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
