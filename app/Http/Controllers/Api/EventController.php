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

        $query->orderBy('events.created_at', 'desc');


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
        $event = Event::with('talks.customers')->findOrFail($id);

        // Return the event as a resource, which will automatically handle the response format
        return $this->success(
            'Event details',
            new ApiEventResource($event, true)
        );
    }

    public function Eventspeakers($id)
    {
        $speakers = Customer::where("type", "speaker")
               ->where(function ($query) use ($id) {
                   $query->whereHas('talks', function ($q) use ($id) {
                       $q->where('event_id', $id);
                   })
                   ->orWhereHas('workshops', function ($q) use ($id) {
                       $q->where('event_id', $id);
                   });
               })
               ->with([
                   'talks' => function ($query) use ($id) {
                       $query->where('event_id', $id);
                   },
                   'workshops' => function ($query) use ($id) {
                       $query->where('event_id', $id);
                   }
               ])
               ->get();
        return $this->success(
            'speakers',
            TalkersResource::collection($speakers)
        );
    }




    public function getAgenda($id)
    {
        $agenda = Agenda::where('event_id', $id)->first();

        if (!$agenda) {
            return response()->json(['error' => 'Agenda not found'], 404);
        }

        $days = $agenda->days; // Assuming Agenda has a relationship with days
        $activities = [];

        foreach ($days as $day) {
            $date = $day->date; // Assuming each day has a date field
            $event = $day->event;

            // Collecting and sorting talks by start_time, then by end_time
            $talks = $event->talks
            ->where('day_id', $day->id)
            ->sortBy(function ($talk) {
                return [strtotime($talk->start_time), strtotime($talk->end_time)];
            })
            ->map(function ($talk) {
                return [
                    'id' => $talk->id,
                    'image' => $talk->full_image_path,
                    'name' => $talk->name,
                    'event_name' => $talk->event->name,
                    'location' => $talk->location,
                    'start_day' => $talk->day->date,
                    'valid_time' => strtotime($talk->start_time) < strtotime($talk->end_time),
                ];
            });

            // Collecting and sorting workshops by start_time, then by end_time
            $workshops = $event->workshops
                ->where('day_id', $day->id)
                ->sortBy(function ($workshop) {
                    return [strtotime($workshop->start_time), strtotime($workshop->end_time)];
                })
                ->map(function ($workshop) {
                    return [
                        'id' => $workshop->id,
                        'image' => $workshop->full_image_path,
                        'name' => $workshop->name,
                        'event_name' => $workshop->event->name,
                        'location' => $workshop->location,
                        'start_day' => $workshop->day->date,
                        'valid_time' => strtotime($workshop->start_time) < strtotime($workshop->end_time),
                    ];
                });

            $food = $event->workshops
            ->where('day_id', $day->id)
            ->sortBy(function ($workshop) {
                return [strtotime($workshop->start_time), strtotime($workshop->end_time)];
            })
            ->map(function ($workshop) {
                return [
                    'id' => $workshop->id,
                    'image' => $workshop->full_image_path,
                    'name' => $workshop->name,
                    'event_name' => $workshop->event->name,
                    'location' => $workshop->location,
                    'start_day' => $workshop->day->date,
                    'start_time' => $workshop->start_time,
                    'end_time' => $workshop->end_time,
                    'valid_time' => strtotime($workshop->start_time) < strtotime($workshop->end_time),
                ];
            });
            $register = $event->workshops
            ->where('day_id', $day->id)
            ->sortBy(function ($workshop) {
                return [strtotime($workshop->start_time), strtotime($workshop->end_time)];
            })
            ->map(function ($workshop) {
                return [
                    'id' => $workshop->id,
                        'image' => $workshop->full_image_path,
                        'name' => $workshop->name,
                        'event_name' => $workshop->event->name,
                        'location' => $workshop->location,
                        'start_day' => $workshop->day->date,
                        'start_time' => $workshop->start_time,
                        'end_time' => $workshop->end_time,
                        'valid_time' => strtotime($workshop->start_time) < strtotime($workshop->end_time),
                ];
            });

            $another = $event->workshops
            ->where('day_id', $day->id)
            ->sortBy(function ($workshop) {
                return [strtotime($workshop->start_time), strtotime($workshop->end_time)];
            })
            ->map(function ($workshop) {
                return [
                    'id' => $workshop->id,
                    'image' => $workshop->full_image_path,
                    'name' => $workshop->name,
                    'event_name' => $workshop->event->name,
                    'location' => $workshop->location,
                    'start_day' => $workshop->day->date,
                    'start_time' => $workshop->start_time,
                    'end_time' => $workshop->end_time,

                    'valid_time' => strtotime($workshop->start_time) < strtotime($workshop->end_time),
                ];
            });


            // Merging all activities into one collection
            $allActivities = collect()
            ->merge($register)
            ->merge($talks)
            ->merge($food)
            ->merge($another)
            ->merge($workshops)
            // ->sortBy([
            //     fn ($item) => strtotime($item['start_time']),
            //     fn ($item) => strtotime($item['end_time'])
            // ])
            ->values(); // Reset keys after sorting
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
