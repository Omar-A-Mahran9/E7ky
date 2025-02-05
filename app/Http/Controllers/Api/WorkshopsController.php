<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreWorkshopsRequest;
use App\Http\Resources\Api\WorkshopsResource;
use App\Models\Customer;
use App\Models\Talk;
use App\Models\Workshop;

class WorkshopsController extends Controller
{
    public function index()
    {
        // Get all talks, possibly paginated
        $Workshops = Workshop::with(['customers', 'event'])->get();
        $Workshops_count = Workshop::with(['customers', 'event'])->count();

        return $this->success('Talks', ["workshops_count" => $Workshops_count,"workshops" => WorkshopsResource::collection($Workshops)]);

    }
    public function store(StoreWorkshopsRequest $request)
    {
        // Get validated data and extract 'customer_ids'
        $validatedData = $request->validated();
        $customerIds = $validatedData['customer_ids'] ?? [];

        // Ensure all customer_ids are of type 'speaker'
        $validCustomerIds = Customer::whereIn('id', $customerIds)
            ->where('type', 'speaker')
            ->pluck('id')
            ->toArray();

        if (count($validCustomerIds) !== count($customerIds)) {
            return $this->failure('Some customers are not speakers.', 422);
        }
        // Remove 'customer_ids' from validated data before creating the Workshop
        unset($validatedData['customer_ids']);
        // Create a new Workshop
        $workshop = Workshop::create($validatedData);

        // Attach validated customers (Many-to-Many)
        $workshop->customers()->attach($validCustomerIds);

        // Return success response
        return $this->success('Workshop created successfully', [
            'workshop' => $workshop->load('customers') // Load customers in response
        ], 201);
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
        $Workshops = Workshop::with(['customers', 'event'])->findOrFail($id);

        return $this->success(
            'Workshop',
            new WorkshopsResource($Workshops, true) // This returns full details
        );
    }


}
