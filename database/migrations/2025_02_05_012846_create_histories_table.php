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
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('article_id');
            $table->string('meta_title', 255)->nullable();
            $table->string('meta_description', 255)->nullable();
            $table->string('meta_keywords', 255)->nullable();
            $table->text('html_tags')->nullable();
            $table->string('name', 255);
            $table->text('description');
            $table->longText('content');
            $table->string('image', 255)->nullable();
            $table->string('slide_image', 255);
            $table->string('internal_image', 255);
            $table->string('video', 255)->nullable();
            $table->integer('status');
            $table->unsignedBigInteger('category_id');
            $table->integer('img_or_vid')->nullable();
            $table->integer('is_slide_show');
            $table->date('schedule')->nullable();
            $table->integer('views')->nullable();
            $table->unsignedBigInteger('campaign_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histories');
    }
};
