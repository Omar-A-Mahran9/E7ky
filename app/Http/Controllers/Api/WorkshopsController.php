<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreWorkshopsRequest;
use App\Http\Resources\Api\WorkshopsResource;
use App\Models\Talk;
use App\Models\Workshop;

class WorkshopsController extends Controller
{
    public function index()
    {
        // Get all talks, possibly paginated
        $Workshops = Workshop::with(['customer', 'event'])->get();
        $Workshops_count = Workshop::with(['customer', 'event'])->count();

        return $this->success('Talks', ["workshops_count" => $Workshops_count,"workshops" => WorkshopsResource::collection($Workshops)]);

    }

    public function store(StoreWorkshopsRequest $request)
    {
        // Create a new Talk using the validated data from the request
        $workshop = Workshop::create($request->validated());

        // Return success response
        return $this->success('workshop created successfully', ['workshop' => $workshop], 201);
    }

    public function WorkshopPerEvent($id)
    {
        // Create a new Talk using the validated data from the request
        $Workshop = Workshop::where("event_id", $id)->get();
        $Workshop_count = Workshop::where("event_id", $id)->count();

        return $this->success('Workshop', ["Workshop_count" => $Workshop_count,"Workshop" => WorkshopsResource::collection($Workshop)]);
    }


    public function show($id)
    {
        $Workshops = Workshop::with(['customer', 'event'])->findOrFail($id);

        return $this->success(
            'Workshop',
            new WorkshopsResource($Workshops, true) // This returns full details
        );
    }


}
