<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Day;
use App\Models\Event;
use App\Models\Session;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('view_sessions');
        if ($request->ajax()) {

            $data = getModelData(model: new Session());
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

}
