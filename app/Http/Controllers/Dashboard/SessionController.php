<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreSessionRequest;
use App\Models\Day;
use App\Models\Event;
use App\Models\Talk;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('view_sessions');
        if ($request->ajax()) {

            $data = getModelData(model: new Talk());
            return response()->json($data);

        } else {
            $events = Event::get();
            $days = Day::get();

            return view('dashboard.sessions.index', compact('events', 'days'));
        }
    }

    public function getDaysByEvent($eventId)
    {
        $days = Day::where('event_id', $eventId)->get(); // Fetch related days
        return response()->json($days);
    }

    public function store(StoreSessionRequest $request)
    {
        $this->authorize('create_sessions');

        $validated_data = $request->validated();

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated_data['image'] = uploadImageToDirectory($request->file('image'), "Events");

        }
        // Create event
        $session = Talk::create($validated_data);
    }


    public function destroy($talk)
    {

        $talk = Talk::find($talk);
        $this->authorize('delete_sessions');

        $talk->delete();

        return response(["session deleted successfully"]);
    }


}
