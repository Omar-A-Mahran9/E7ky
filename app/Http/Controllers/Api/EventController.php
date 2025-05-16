<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreEventRequest as ApiStoreEventRequest;
use App\Http\Resources\Api\EventResource as ApiEventResource;
use App\Http\Resources\Api\TalkersResource;
use App\Models\Agenda;
use App\Models\Customer;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
public function index(Request $request)
{
    $query = Event::query();

    if ($request->has('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('events.name_ar', 'LIKE', "%{$search}%")
              ->orWhere('events.name_en', 'LIKE', "%{$search}%")
              ->orWhereHas('talks', function ($talkQuery) use ($search) {
                  $talkQuery->where('talks.name_ar', 'LIKE', "%{$search}%")
                            ->orWhere('talks.name_en', 'LIKE', "%{$search}%");
              });
        });
    }

    if ($request->has('status')) {
        $status = $request->status;
        if ($status === 'upcoming') {
            $query->where('start_day', '>', now());
        } elseif ($status === 'past') {
            $query->where('end_day', '<', now());
        }
    }

    $query->orderBy('events.created_at', 'desc');

    $events = $query->paginate(10);

    return $this->successWithPagination('Events', $events);
}


    public function store(ApiStoreEventRequest $request)
    {
        $event = Event::create($request->validated());
        return $this->success('Event created successfully', ['event' => $event]);
    }

    public function show($id, Request $request)
    {
        // Fetch the event by its ID along with its relations (talks and customer)
        $event = Event::with('talks.customers')->findOrFail($id);

        // Return the event as a resource, which will automatically handle the response format
        return $this->success(
            'Event details',
            new ApiEventResource($event, true)
        );
    }

    public function Eventspeakers(Request $request, $id)
    {
        $query = Customer::where("type", "speaker")
            ->where(function ($query) use ($id) {
                $query->whereHas('talks', function ($q) use ($id) {
                    $q->where('event_id', $id);
                })
                ->orWhereHas('workshops', function ($q) use ($id) {
                    $q->where('event_id', $id);
                });
            });

        // Search by first_name and last_name
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
        $speakers = $query->with([
            'talks' => function ($query) use ($id) {
                $query->where('event_id', $id);
            },
            'workshops' => function ($query) use ($id) {
                $query->where('event_id', $id);
            }
        ])->paginate(10);

        return $this->success(
            'speakers',
            TalkersResource::collection($speakers)
        );
    }


 public function getAgenda(Request $request, $id)
{
    $dateFilter = $request->query('date'); // Get the date from query parameters

    $agenda = Agenda::where('event_id', $id)->first();

    if (!$agenda) {
        return response()->json(['error' => 'Agenda not found'], 404);
    }

    $days = $agenda->days; // Assuming Agenda has a relationship with days
    $activities = [];

    foreach ($days as $day) {
        if ($dateFilter && $day->date != $dateFilter) {
            continue; // Skip days that do not match the filter
        }

        $date = $day->date;
        $event = $day->event;

        $collectActivities = function ($items) use ($day) {
            return $items->where('day_id', $day->id)
                ->sortBy(function ($item) {
                    return [strtotime($item->start_time), strtotime($item->end_time)];
                })
                ->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'image' => $item->full_image_path,
                        'name' => $item->name,
                        'event_name' => $item->event->name,
                        'location' => $item->location,
                        'start_day' => $item->day->date,
                        'start_time' => $item->start_time,
                        'end_time' => $item->end_time,
                        'style'=>1,
                        'valid_time' => strtotime($item->start_time) < strtotime($item->end_time),
                    ];
                });
        };

        $talks = $collectActivities($event->talks);
        $workshops = $collectActivities($event->workshops);
        $food = $collectActivities($event->workshops);
        $register = $collectActivities($event->workshops);
        $another = $collectActivities($event->workshops);

        $allActivities = collect()
            ->merge($register)
            ->merge($talks)
            ->merge($food)
            ->merge($another)
            ->merge($workshops)
            ->values(); // Reset keys after merging

        $activities[] = [
            'date' => $date,
            'activities' => $allActivities
        ];
    }

    return response()->json([
        'agenda' => $activities
    ]);
}




}
