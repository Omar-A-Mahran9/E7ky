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
            $table->string('name_ar');
            $table->string('name_en');

            $table->longText('description_ar');
            $table->longText('description_en');

            $table->longText('content_ar');
            $table->longText('content_en');

            $table->string('image')->nullable();
            $table->string('slide_image');
            $table->string('internal_image');
            $table->string('video')->nullable();
            $table->string('status');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('admin_id');
            $table->integer('img_or_vid')->nullable();
            $table->integer('is_slide_show');
            $table->date('schedule')->nullable();
            $table->integer('views')->default(0);
            $table->unsignedBigInteger('campaign_id')->nullable();
            $table->unsignedBigInteger('tag_id')->nullable();
            $table->integer('is_latest')->nullable();
            $table->string('name_for_latest')->nullable();
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
            $table->foreign('campaign_id')->references('id')->on('campaigns')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
