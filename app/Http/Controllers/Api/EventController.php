<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreEventRequest as ApiStoreEventRequest;
 use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        return $this->success('', ['events' => Event::all()]);
    }

    public function store(ApiStoreEventRequest $request)
    {
        $event = Event::create($request->validated());
        return $this->success('Event created successfully', ['event' => $event]);
    }

}
