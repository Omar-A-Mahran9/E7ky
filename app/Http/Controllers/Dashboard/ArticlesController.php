<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreEventRequest;
use App\Http\Requests\Dashboard\UpdateEventRequest;
use App\Http\Requests\StoreArticleRequest;
use App\Models\Agenda;
use App\Models\Article;
use App\Models\Day;
use App\Models\DaysEvent;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('view_articles');
        if ($request->ajax()) {

            $data = getModelData(model: new Article());
            return response()->json($data);

        } else {
            return view('dashboard.articles.index');
        }
    }



    public function store(StoreArticleRequest $request)
    {
        $this->authorize('create_article'); // Ensure the user is authorized to create an article

        $validated_data = $request->validated();

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated_data['image'] = uploadImageToDirectory($request->file('image'), 'Articles');
        }

        // Handle slide image upload
        if ($request->hasFile('slide_image')) {
            $validated_data['slide_image'] = uploadImageToDirectory($request->file('slide_image'), 'Articles/Slides');
        }

        // Handle internal image upload
        if ($request->hasFile('internal_image')) {
            $validated_data['internal_image'] = uploadImageToDirectory($request->file('internal_image'), 'Articles/Internal');
        }

        // Handle video URL
        if ($request->has('video')) {
            $validated_data['video'] = $request->input('video');
        }

        // Set the slug for the article (e.g., based on the title)
        $validated_data['slug'] = Str::slug($validated_data['name_en']);

        // Create the article
        $article = Article::create($validated_data);

        // Optionally handle article tagging, campaign, and other related models if needed.
        if ($request->has('tag_id')) {
            $article->tags()->attach($request->tag_id); // Assuming a many-to-many relationship
        }

        // Return a success response with the created article
        return response()->json([
            'message' => 'Article created successfully!',
            'article' => $article,
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
