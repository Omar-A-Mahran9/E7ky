<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreArticleRequest as DashboardStoreArticleRequest;
use Illuminate\Support\Str;
  use App\Models\Agenda;
use App\Models\Article;
use App\Models\Campaign;
use App\Models\Category;
use App\Models\Day;
use App\Models\DaysEvent;
use App\Models\Event;
use App\Models\Tag;
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
        $categories = Category::all();
        $campaigns = Campaign::all();
        $tags = Tag::all();  // <-- add this line

        return view('dashboard.articles.index', compact('categories', 'campaigns', 'tags'));
    }
}






   public function store(DashboardStoreArticleRequest $request)
{
    $this->authorize('create_articles');

    $data = $request->validated();

    $data['image'] = uploadImageToDirectory($request->file('image'), 'Articles');
    $data['internal_image'] = uploadImageToDirectory($request->file('internal_image'), 'Articles/Internal');

    $data['slide_image'] = $request->hasFile('slide_image')
        ? uploadImageToDirectory($request->file('slide_image'), 'Articles/Slides')
        : null;

    $data['slug'] = Str::slug($data['name_en']);
    $data['admin_id'] = auth()->id();
        unset($data['tag_id']);  // remove tag_id from $data array if exists
    unset($data['campaign_id']);  // also remove campaign_id if present in $data
    $article = Article::create($data);

    $article->tags()->attach($request->tag_id);
    $article->campaigns()->attach($request->campaign_id);


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
