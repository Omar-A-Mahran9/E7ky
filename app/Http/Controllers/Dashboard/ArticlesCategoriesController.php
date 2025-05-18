<?php

namespace App\Http\Controllers\Dashboard;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreCategoryRequest as DashboardStoreCategoryRequest;
use App\Http\Requests\Dashboard\UpdateEventRequest;
use App\Models\Agenda;
 use App\Models\Category;
use App\Models\Day;
use App\Models\DaysEvent;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Stringable;

class ArticlesCategoriesController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $categories = Category::all();
            return response()->json($categories);
        }

        return view('dashboard.articles_categories.index');
    }


      public function store(DashboardStoreCategoryRequest $request)
      {
          $this->authorize('create_category'); // Ensure the user is authorized to create a category

          // Validate and retrieve validated data from the request
          $validated_data = $request->validated();

          // Handle image upload for the category
          if ($request->hasFile('image')) {
              $validated_data['image'] = uploadImageToDirectory($request->file('image'), 'Categories');
          }

          // Handle mobile image upload for the category (img_for_mob)
          if ($request->hasFile('img_for_mob')) {
              $validated_data['img_for_mob'] = uploadImageToDirectory($request->file('img_for_mob'), 'Categories/Mobile');
          }

          // Set the slug for the category (e.g., based on the English name)
          $validated_data['slug'] = Str::slug($validated_data['name_en']);

          // Create the category
          $category = Category::create($validated_data);


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
