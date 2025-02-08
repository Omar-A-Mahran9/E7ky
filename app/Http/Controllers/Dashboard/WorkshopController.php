<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreWorkshopsRequest;
use App\Models\Customer;
use App\Models\Day;
use App\Models\Event;
use App\Models\Workshop;
use Illuminate\Http\Request;

class WorkshopController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('view_workshops');

        if ($request->ajax()) {
            $data = getModelData(model: new Workshop());
            return response()->json($data);

        } else {
            $events = Event::get();
            $days = Day::get();
            $customers = Customer::where('type', 'speaker')->get();
            return view('dashboard.workshops.index', compact('events', 'days', 'customers'));
        }
    }

    public function getDaysByEvent($eventId)
    {
        $days = Day::where('event_id', $eventId)->get(); // Fetch related days
        return response()->json($days);
    }


    public function store(StoreWorkshopsRequest $request)
    {
        // Get validated data and remove 'customer_ids'
        $validatedData = $request->validated();
        $customerIds = $validatedData['customer_ids'] ?? [];

        // Ensure all customer_ids are of type 'speaker'
        $validCustomerIds = Customer::whereIn('id', $customerIds)
            ->where('type', 'speaker')
            ->pluck('id')
            ->toArray();

        if (count($validCustomerIds) !== count($customerIds)) {
            return $this->failure('Some customers are not speakers.', 422);
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $validatedData['image'] = uploadImageToDirectory($request->file('image'), "Workshops");
        }

        // Remove 'customer_ids' from validated data before creating the Talk
        unset($validatedData['customer_ids']);

        // Create a new Talk
        $Workshop = Workshop::create($validatedData);

        // Attach validated customers (Many-to-Many)
        $Workshop->customers()->attach($validCustomerIds);

        // Return success response
        return $this->success('Workshop created successfully', [
            'Workshop' => $Workshop->load('customers') // Load customers in response
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

    public function destroy($talk)
    {

        $talk = Workshop::find($talk);
        $this->authorize('delete_workshops');

        $talk->delete();

        return response(["workshop deleted successfully"]);
    }

}
