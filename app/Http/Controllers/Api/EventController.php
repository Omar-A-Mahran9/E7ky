<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreEventRequest as ApiStoreEventRequest;
use App\Http\Resources\Api\EventResource as ApiEventResource;
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

    public function show($id, Request $request)
    {
        // Fetch the event by its ID along with its relations (talks and customer)
        $event = Event::with('talks.customer')->findOrFail($id);

        // Return the event as a resource, which will automatically handle the response format
        return $this->success(
            'Event details',
            new ApiEventResource($event, true)
        );
    }


    public function Eventspeakers($id)
    {
        // Fetch the event by its ID along with the related talks and customers
        $event = Event::with('talks.customer')->findOrFail($id);

        // Fetch all customers associated with the event
        $customers = $event->talks->pluck('customer')->unique('id');

        // Prepare the response data with talk count per customer
        $talksData = $customers->map(function ($customer) use ($event) {
            // Get talks for each customer
            $talks = $event->talks->where('customer_id', $customer->id);
            $workshops = $event->workshops->where('customer_id', $customer->id);

            return [
                'talker_details' => [
                    "id" => $customer->id,
                    "name" => $customer->first_name . ' ' . $customer->last_name

                ],
                'sessions_count' => $talks->count(), // Count talks per customer
                'talks' => $talks->map(function ($talk) {
                    return [
                        'id' => $talk->id,
                        'talk_name' => $talk->name, // You can return the talk name if needed
                    ];
                }),
                'workshop' => $workshops->map(function ($workshop) {
                    return [
                        'id' => $workshop->id,
                        'workshop_name' => $workshop->name, // You can return the talk name if needed
                    ];
                })
            ];
        });

        // Return the event's talks grouped by customer and talks count in the response
        return $this->success(
            'Event talks data',
            $talksData
        );
    }




}
