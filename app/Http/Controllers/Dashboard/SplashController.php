<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreSplashRequest;
use App\Models\Splash;
use Illuminate\Http\Request;

class SplashController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('view_splashes');
        if ($request->ajax()) {

            $data = getModelData(model: new Splash());
            return response()->json($data);

        } else {
            return view('dashboard.splashes.index');
        }
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSplashRequest $request)
    {

        $this->authorize('create_splashes');

        $validated_data = $request->validated();

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated_data['image'] = uploadImageToDirectory($request->file('image'), "Splash");

        }

         $splash = Splash::create($validated_data);
         return response(["splash deleted successfully"]);

    }


    /**
     * Update the specified resource in storage.
     */
    /**
     * Update the specified resource in storage.
     */
    public function update(StoreSplashRequest $request, Splash $splash)
    {
        $this->authorize('update_splashes');

        $validated_data = $request->validated();

        // Handle image update
        if ($request->hasFile('image')) {
            // Delete the old image
            deleteImageFromDirectory($splash->image, 'Splash');

            // Upload new image
            $validated_data['image'] = uploadImageToDirectory($request->file('image'), "Splash");
        }

        // Update event
        $splash->update($validated_data);

        return response()->json(['message' => 'Splash updated successfully', 'splash' => $splash]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Splash $splash)
    {
        $this->authorize('delete_splashes');

        // Delete associated image
        deleteImageFromDirectory($splash->image, 'Splash');

        // Delete the splash record
        $splash->delete();

        return response()->json(['message' => 'Splash deleted successfully']);
    }
    public function deleteSelected(Request $request)
    {
        $this->authorize('delete_splashes');

        Splash::whereIn('id', $request->selected_items_ids)->delete();

        return response(["selected splashes deleted successfully"]);
    }

    public function restoreSelected(Request $request)
    {
        $this->authorize('delete_splashes');
        Splash::withTrashed()->whereIn('id', $request->selected_items_ids)->restore();

        return response(["selected splashes restored successfully"]);
    }

}
