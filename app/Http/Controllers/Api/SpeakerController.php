<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\TalkersResource;
use App\Models\Customer;
use Illuminate\Http\Request;

class SpeakerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Customer::where("type", "speaker");

        // Search by direct first_name and last_name
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'LIKE', "%{$search}%")
                  ->orWhere('last_name', 'LIKE', "%{$search}%");
            });
        }

        // Sort by created_at
        $query->orderBy('created_at', 'asc');

        // Paginate results
        $speakers = $query->paginate(10);

        return $this->success(
            'speakers',
            TalkersResource::collection($speakers)
        );
    }




    public function show($id)
    {
        $speaker = Customer::where("type", "speaker")->findOrFail($id);

        return $this->success(
            'speaker',
            new TalkersResource($speaker, true) // This returns full details
        );
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
