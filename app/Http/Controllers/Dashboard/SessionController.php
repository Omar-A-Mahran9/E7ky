<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
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
            return view('dashboard.sessions.index');
        }
    }
}
