<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreEventRequest;
use App\Http\Requests\Dashboard\UpdateEventRequest;
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



    public function store(StoreEventRequest $request)
    {
        $this->authorize('create_event');

        $validated_data = $request->validated();
        $validated_data['lat']=30.0444;
        $validated_data['lon']=31.2357;
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
                  'event_id' => $agenda->event_id
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



    public function update(UpdateEventRequest $request,Event $event)
    {
        $this->authorize('update_event');

        // $event = Event::findOrFail($id);
        $validated_data = $request->validated();

        // Force lat/lon if needed
        $validated_data['lat'] = 30.0444;
        $validated_data['lon'] = 31.2357;

        // Handle new image upload
        if ($request->hasFile('image')) {
            $validated_data['image'] = uploadImageToDirectory($request->file('image'), "Events");
        } else {
            $validated_data['image'] = $event->image; // Preserve old image if not updated
        }

        // Handle event map upload
        if ($request->hasFile('event_map')) {
            $validated_data['event_map'] = uploadImageToDirectory($request->file('event_map'), "Events/maps");
        } else {
            $validated_data['event_map'] = $event->event_map; // Preserve old map if not updated
        }

        // Update the event
        $event->update($validated_data);

        // Update related agenda (assumes one-to-one relationship)
        $agenda = Agenda::updateOrCreate(
            ['event_id' => $event->id],
            [
                'name_ar' => $event->name_ar . ' - جدول',
                'name_en' => $event->name_en . ' - Agenda',
                'description_ar' => 'جدول الحدث: ' . $event->description_ar,
                'description_en' => 'Agenda for the event: ' . $event->description_en,
                'start_day' => $event->start_day,
                'end_day' => $event->end_day,
            ]
        );


       

        // Handle days and days_events
        $startDay = Carbon::parse($event->start_day);
        $endDay = $event->end_day ? Carbon::parse($event->end_day) : $startDay;
        Carbon::setLocale('ar');
        $dates = collect($startDay->daysUntil($endDay->copy()->addDay()));

        foreach ($dates as $date) {
            $dayNameAr = $date->translatedFormat('l');
            $dayNameEn = $date->format('l');

            $day = Day::updateOrCreate([
                'date' => $date->toDateString(),
                'event_id' => $event->id,
            ], [
                'name_ar' => $agenda->name_ar . ' - ' . $dayNameAr,
                'name_en' => $agenda->name_en . ' - ' . $dayNameEn,
            ]);

            DaysEvent::updateOrCreate([
                'day_id' => $day->id,
                'event_id' => $event->id,
            ], [
                'agenda_id' => $agenda->id,
            ]);
        }

        return response()->json([
            'message' => 'Event updated successfully!',
            'event' => $event,
        ], 200);
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
