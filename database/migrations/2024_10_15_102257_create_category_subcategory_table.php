<?php

use App\Models\Category;
use App\Models\SubCategory;
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

        Schema::create('category_subcategory', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->foreignId('sub_category_id')->constrained('sub_categories')->onDelete('cascade');
            $table->timestamps();
        });
        $categories = Category::with('children')->where('parent_id', null)->get();
        foreach ($categories as $key => $category) {
            if ($category->children) {
                foreach ($category->children as $key => $children) {
                    # code...
                    $subCategory = SubCategory::where('name_ar', $children->name_ar)->first();
                    if ($subCategory) {
                        $category->subcategories()->attach($subCategory->id);
                    }
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_subcategory');
    }
};
