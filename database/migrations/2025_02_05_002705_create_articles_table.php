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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->text('html_tags')->nullable();
            $table->string('name');
            $table->text('description');
            $table->longText('content');
            $table->string('image')->nullable();
            $table->string('slide_image');
            $table->string('internal_image');
            $table->string('video')->nullable();
            $table->string('status');
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('admin_id');
            $table->integer('img_or_vid')->nullable();
            $table->integer('is_slide_show');
            $table->date('schedule')->nullable();
            $table->integer('views')->default(0);
            $table->unsignedInteger('campaign_id')->nullable();
            $table->unsignedInteger('tag_id')->nullable();
            $table->integer('is_latest')->nullable();
            $table->string('name_for_latest')->nullable();
            $table->string('slug');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
