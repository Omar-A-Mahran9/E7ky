<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreWorkshopsRequest;
use App\Http\Resources\Api\WorkshopsResource;
use App\Models\Book;
use App\Models\Customer;
use App\Models\Talk;
use App\Models\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class WorkshopsController extends Controller
{
    public function index()
    {

        // Get all talks, possibly paginated
        $Workshops = Workshop::with(['customers', 'event'])->get();
        $Workshops_count = Workshop::with(['customers', 'event'])->count();

        return $this->success('Talks', ["workshops_count" => $Workshops_count,"workshops" => WorkshopsResource::collection($Workshops)]);

    }
    public function store(StoreWorkshopsRequest $request)
    {
        // Get validated data and extract 'customer_ids'
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
        // Remove 'customer_ids' from validated data before creating the Workshop
        unset($validatedData['customer_ids']);
        // Create a new Workshop
        $workshop = Workshop::create($validatedData);

        // Attach validated customers (Many-to-Many)
        $workshop->customers()->attach($validCustomerIds);

        // Return success response
        return $this->success('Workshop created successfully', [
            'workshop' => $workshop->load('customers') // Load customers in response
        ], 201);
    }


    public function WorkshopPerEvent($id)
    {
        // Create a new Talk using the validated data from the request
        $Workshop = Workshop::where("event_id", $id)->get();
        $Workshop_count = Workshop::where("event_id", $id)->count();

        return $this->success('Workshop', ["Workshop_count" => $Workshop_count,"Workshop" => WorkshopsResource::collection($Workshop)]);
    }


    public function show($id)
    {
        $Workshops = Workshop::with(['customers', 'event'])->findOrFail($id);

        return $this->success(
            'Workshop',
            new WorkshopsResource($Workshops, true) // This returns full details
        );
    }

    public function Bookworkshop(Request $request, $id)
    {
        $request->validate([
            'ticket_id' => 'required|unique:booking,ticket_id',
        ]);
        $workshop = Workshop::with(['event'])->findOrFail($id);
        $customer=Auth::user();
        if($customer->type=="customer"){
            if ($workshop->capacity > 0) {
                $existingBooking = Book::where('workshop_id', $workshop->id)
                ->where('customer_id', Auth::id())
                ->exists();

            if ($existingBooking) {
                return response()->json([
                    'message' => __('You have already booked this workshop'),
                    'errors' => [
                        'ticket_id' => [__('You have already booked this workshop')]
                    ]
                ], 422);
            }
            // Create booking
                // Generate unique booking reference
                $bookingReference = strtoupper(uniqid('REF-'));


                $booking = Book::create([
                    'event_id' => $workshop->event->id ?? null,
                    'workshop_id' => $workshop->id,
                    'customer_id' => Auth::id(),
                    'status' => 'confirmed', // Mark as confirmed by default
                    'type' => 'workshop',
                    'ticket_id' => $request->ticket_id,
                    'booked_at' => now(),
                    'event_date' => $talk->event->event_date ?? null,
                    'price' => $talk->price ?? 0, // Assuming talk has a price field
                    'booking_reference' => $bookingReference,
                ]);
             $qrCode = QrCode::format('png')->size(200)->generate($booking->id);
             $qrCodePath = uploadImageToDirectory($qrCode, "qrcodes");

            // Update Booking with Relative Path
            $booking->update([
                'qr' =>  $qrCodePath , // Stores "qrcodes/E7kky_XXXX.png"
            ]);
            // Decrease talk capacity
            $workshop->update(['capacity' => $workshop->capacity - 1]);


            return $this->success('qr_code_url', ["qr_code_url" => getImagePathFromDirectory($booking->qr,"qrcodes")]);


            }
        }
        else{
            return $this->failure('You are not a customer may be speaker', 422);
        }



        return response()->json(['message' => 'No available capacity for this talk'], 400);
    }


}
