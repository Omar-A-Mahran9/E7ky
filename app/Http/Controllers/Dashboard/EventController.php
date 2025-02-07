<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreEventRequest;
use App\Models\Agenda;
use App\Models\Day;
use App\Models\DaysEvent;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('view_event');
        if ($request->ajax()) {

            $data = getModelData(model: new Event());
            return response()->json($data);

        } else {
            return view('dashboard.events.index');
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(StoreEventRequest $request)
    {
        $this->authorize('create_event');

        $validated_data = $request->validated();

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated_data['image'] = uploadImageToDirectory($request->file('image'), "Events");

        }
        // Handle event_map upload
        if ($request->hasFile('event_map')) {
            $validated_data['event_map'] = uploadImageToDirectory($request->file('image'), "Events/maps");
        }

        // Create event
        $event = Event::create($validated_data);
        // Create default agenda for the event
        $agendaData = [
         'name_ar' => $event->name_ar . ' - جدول', // Arabic event name + "جدول"
         'name_en' => $event->name_en . ' - Agenda', // English event name + "Agenda"
         'description_ar' => 'جدول الحدث: ' . $event->description_ar, // Arabic description
         'description_en' => 'Agenda for the event: ' . $event->description_en, // English description
         'start_day' => $event->start_day,
         'end_day' => $event->end_day,
         'event_id' => $event->id,
        ];
        // Create Agenda
        $agenda = Agenda::create($agendaData);

        // Determine the date range
        $startDay = Carbon::parse($request->start_day);
        $endDay = $request->end_day ? Carbon::parse($request->end_day) : $startDay; // If no end_day, use start_day

        // Set Arabic locale for Carbon
        Carbon::setLocale('ar'); // Ensure you have Arabic locale installed on your server

        // Generate an array of dates from start_day to end_day
        $dates = collect($startDay->daysUntil($endDay->addDay())->toArray());

        // Loop through each date
        foreach ($dates as $date) {
            $dayNameAr = $date->translatedFormat('l'); // Arabic day name
            $dayNameEn = $date->format('l'); // English day name

            $day =  Day::firstOrCreate([
                  'date' => $date->toDateString(),
              ], [
                  'name_ar' => $agenda->name_ar . " - " . $dayNameAr,
                  'name_en' => $agenda->name_en . " - " . $dayNameEn,
              ]);
            DaysEvent::firstOrCreate([
              'day_id' => $day->id,
              'event_id' => $agenda->event_id, // Ensure event_id is available
              'agenda_id' => $agenda->id
            ]);
        }

        return response()->json([
            'message' => 'Event created successfully!',
            'event' => $event,
        ], 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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

    public function destroy(Event $event)
    {
        $this->authorize('delete_event');

        $event->delete();

        return response(["event deleted successfully"]);
    }

    // public function deleteSelected(Request $request)
    // {
    //     $this->authorize('delete_newsletter');

    //     NewsLetter::whereIn('id', $request->selected_items_ids)->delete();

    //     return response(["selected newsletters deleted successfully"]);
    // }
}
