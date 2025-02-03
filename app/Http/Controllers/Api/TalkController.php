<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreTalkRequest;
use App\Models\Talk;
use Illuminate\Http\Request;

class TalkController extends Controller
{
    public function index()
    {
        // Get all talks, possibly paginated
        $talks = Talk::with(['customer', 'event'])->get();
        return $this->success('Event created successfully', ['talks' => $talks]);
    }

    public function store(StoreTalkRequest $request)
    {
        // Create a new Talk using the validated data from the request
        $talk = Talk::create($request->validated());

        // Return success response
        return $this->success('Talk created successfully', ['talk' => $talk], 201);
    }

}
