<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreEventRequest as ApiStoreEventRequest;
use App\Http\Resources\Api\EventResource as ApiEventResource;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::query();

        // Filter by upcoming or past events
        if ($request->has('status')) {
            if ($request->status === 'upcoming') {
                $query->where('start_day', '>=', now()->toDateString());
            } elseif ($request->status === 'past') {
                $query->where('end_day', '<', now()->toDateString());
            }
        }

        // Search by event name, talks, or customer name
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name_ar', 'LIKE', "%{$search}%")
                  ->orWhere('name_en', 'LIKE', "%{$search}%")
                  ->orWhereHas('talks', function ($t) use ($search) {
                      $t->where('name_ar', 'LIKE', "%{$search}%")
                        ->orWhere('name_en', 'LIKE', "%{$search}%")
                        ->orWhereHas('customer', function ($c) use ($search) { // ✅ Fix: Correct relation name
                            $c->where('name_ar', 'LIKE', "%{$search}%") // ✅ Fix: Use correct column name
                              ->orWhere('name_en', 'LIKE', "%{$search}%");
                        });
                  });
            });
        }

        // Sort by event start date
        $query->orderBy('start_day', 'asc');

        // Paginate the results
        $events = $query->paginate(10);

        return $this->success(
            'Events',
            ApiEventResource::collection($events)
        );
    }

    public function store(ApiStoreEventRequest $request)
    {
        $event = Event::create($request->validated());
        return $this->success('Event created successfully', ['event' => $event]);
    }

}
