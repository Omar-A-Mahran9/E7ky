<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StorePackageRequest;
use App\Models\Cars;
use App\Models\City;
use App\Models\PackageCategory;
use App\Models\Packages;
use Illuminate\Http\Request;

class PackagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         $count_Category =Packages::count(); // Get the count of blogs
         $cities = City::get();
         $cars = Cars::get();
         $categoriesPackage = PackageCategory::get();

         $visited_site=10000;
         if ($request->ajax())
            return response(getModelData(model: new Packages()));
        else
            return view('dashboard.packages.index',compact('count_Category','visited_site','cities','cars','categoriesPackage'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePackageRequest $request)
    {
        $this->authorize('create_packages');

        $data          = $request->validated();
        $brand = Packages::create($data);

        return response(["Package created successfully"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Packages $packages)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Packages $packages)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Packages $packages)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Packages $packages)
    {
        //
    }
}
