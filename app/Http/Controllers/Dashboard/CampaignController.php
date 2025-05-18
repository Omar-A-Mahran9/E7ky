<?php

namespace App\Http\Controllers\Dashboard;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreCampaignRequest;
use App\Http\Requests\Dashboard\StoreCategoryRequest as DashboardStoreCategoryRequest;
use App\Http\Requests\Dashboard\UpdateCampaignRequest;
use App\Http\Requests\Dashboard\UpdateCategoryRequest;
use App\Models\Campaign;
use App\Models\Category;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CampaignController extends Controller
{


       public function index(Request $request)
    {
        $this->authorize('view_campaigns');
        if ($request->ajax()) {

            $data = getModelData(model: new Campaign());
            return response()->json($data);

        } else {
        return view('dashboard.campaigns.index');
        }
    }


      public function store(StoreCampaignRequest $request)
      {
          $this->authorize('create_campaigns'); // Ensure the user is authorized to create a category

          // Validate and retrieve validated data from the request
          $validated_data = $request->validated();

          // Handle image upload for the category
          if ($request->hasFile('image')) {
              $validated_data['image'] = uploadImageToDirectory($request->file('image'), 'Campaigns');
          }

          // Handle mobile image upload for the category (img_for_mob)
          if ($request->hasFile('img_for_mob')) {
              $validated_data['img_for_mob'] = uploadImageToDirectory($request->file('img_for_mob'), 'Campaigns/Mobile');
          }

          // Set the slug for the category (e.g., based on the English name)
          $validated_data['admin_id'] = Auth::user()->id;

          // Create the category
          Campaign::create($validated_data);


      }



public function update(UpdateCampaignRequest $request, $id)
{
     $category=Campaign::find($id);
    $this->authorize('update_campaigns'); // Authorize update

    $validated_data = $request->validated();

    // Delete old image if new image uploaded
    if ($request->hasFile('image')) {
        deleteImageFromDirectory($category->image, 'Campaigns');
        $validated_data['image'] = uploadImageToDirectory($request->file('image'), 'Campaigns');
    }

    // Delete old mobile image if new mobile image uploaded
    if ($request->hasFile('img_for_mob')) {
        deleteImageFromDirectory($category->img_for_mob, 'Campaigns');
        $validated_data['img_for_mob'] = uploadImageToDirectory($request->file('img_for_mob'), 'Campaigns/Mobile');
    }

    // Update slug
          $validated_data['admin_id'] = Auth::user()->id;

    $category->update($validated_data);

 }




public function destroy($id)
{
    $this->authorize('delete_campaigns'); // authorize delete

    $Campaigns = Campaign::findOrFail($id);

    // Delete images from storage if not default
    deleteImageFromDirectory($Campaigns->image, 'Campaigns');
    deleteImageFromDirectory($Campaigns->img_for_mob, 'Campaigns');

    // Delete the category
    $Campaigns->delete();

 }

}



