<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreTalkRequest;
use App\Http\Resources\Api\TalkersResource;
use App\Http\Resources\Api\TalkResource;
use App\Models\Talk;
use Illuminate\Http\Request;

class TalkController extends Controller
{
    public function index()
    {
        // Get all talks, possibly paginated
        $talks = Talk::with(['customers', 'event'])->get();
        return $this->success('Talks', ['talks' => TalkResource::collection($talks)]);
    }
    public function show($id)
    {
        $talk = Talk::with(['customers', 'event'])->findOrFail($id);

        return $this->success(
            'Talk',
            new TalkResource($talk, true) // This returns full details
        );
    }

    public function talksPerEvent($id)
    {
        // Create a new Talk using the validated data from the request
        $talks = Talk::where("event_id", $id)->get();
        $talks_count = Talk::where("event_id", $id)->count();

        return $this->success('Talks', ["talks_count" => $talks_count,"talks" => TalkResource::collection($talks)]);
    }


    public function store(StoreTalkRequest $request)
    {
        // Get validated data and remove 'customer_ids'
        $validatedData = $request->validated();
        $data = array_diff_key($validatedData, ['customer_ids' => '']);

        // Create a new Talk
        $talk = Talk::create($data);        // Create a new Talk

        // Attach multiple customers (Many-to-Many)
        $talk->customers()->attach($request->customer_ids);

        // Return success response
        return $this->success('Talk created successfully', [
            'talk' => $talk->load('customers') // Load customers in response
        ], 201);
    }

}
