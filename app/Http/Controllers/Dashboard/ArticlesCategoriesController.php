<?php

namespace App\Http\Controllers\Dashboard;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreCategoryRequest as DashboardStoreCategoryRequest;
use App\Http\Requests\Dashboard\UpdateCategoryRequest;
use App\Http\Requests\Dashboard\UpdateEventRequest;
use App\Models\Agenda;
 use App\Models\Category;
use App\Models\Day;
use App\Models\DaysEvent;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Stringable;

class ArticlesCategoriesController extends Controller
{


       public function index(Request $request)
    {
        $this->authorize('view_category');
        if ($request->ajax()) {

            $data = getModelData(model: new Category());
            return response()->json($data);

        } else {
        return view('dashboard.articles_categories.index');
        }
    }


      public function store(DashboardStoreCategoryRequest $request)
      {
          $this->authorize('create_category'); // Ensure the user is authorized to create a category

          // Validate and retrieve validated data from the request
          $validated_data = $request->validated();

          // Handle image upload for the category
          if ($request->hasFile('image')) {
              $validated_data['image'] = uploadImageToDirectory($request->file('image'), 'Categories');
          }

          // Handle mobile image upload for the category (img_for_mob)
          if ($request->hasFile('img_for_mob')) {
              $validated_data['img_for_mob'] = uploadImageToDirectory($request->file('img_for_mob'), 'Categories/Mobile');
          }

          // Set the slug for the category (e.g., based on the English name)
          $validated_data['slug'] = Str::slug($validated_data['name_en']);

          // Create the category
          $category = Category::create($validated_data);


      }



public function update(UpdateCategoryRequest $request, $id)
{
     $category=Category::find($id);
    $this->authorize('update_category'); // Authorize update

    $validated_data = $request->validated();

    // Delete old image if new image uploaded
    if ($request->hasFile('image')) {
        deleteImageFromDirectory($category->image, 'category');
        $validated_data['image'] = uploadImageToDirectory($request->file('image'), 'Categories');
    }

    // Delete old mobile image if new mobile image uploaded
    if ($request->hasFile('img_for_mob')) {
        deleteImageFromDirectory($category->img_for_mob, 'category');
        $validated_data['img_for_mob'] = uploadImageToDirectory($request->file('img_for_mob'), 'Categories/Mobile');
    }

    // Update slug
    $validated_data['slug'] = Str::slug($validated_data['name_en']);

    $category->update($validated_data);

 }




public function destroy($id)
{
    $this->authorize('delete_category'); // authorize delete

    $category = Category::findOrFail($id);

    // Delete images from storage if not default
    deleteImageFromDirectory($category->image, 'Category');
    deleteImageFromDirectory($category->img_for_mob, 'Category');

    // Delete the category
    $category->delete();

 }

}



