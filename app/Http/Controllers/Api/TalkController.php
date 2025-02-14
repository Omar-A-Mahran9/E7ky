<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreTalkRequest;
use App\Http\Resources\Api\TalkersResource;
use App\Http\Resources\Api\TalkResource;
use App\Models\Book;
use App\Models\Customer;
use App\Models\Talk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TalkController extends Controller
{
    public function index()
    {
        // Get all talks, possibly paginated
        $talks = Talk::with(['customers', 'event'])->get();

        return $this->success('Talks', ['talks' => TalkResource::collection($talks)]);
    }
    public function show($id)
    {
        $talk = Talk::with(['customers', 'event'])->findOrFail($id);
        return $this->success(
            'Talk',
            new TalkResource($talk, true) // This returns full details
        );
    }

    public function talksPerEvent($id)
    {
        // Create a new Talk using the validated data from the request
        $talks = Talk::where("event_id", $id)->get();
        $talks_count = Talk::where("event_id", $id)->count();

        return $this->success('Talks', ["talks_count" => $talks_count,"talks" => TalkResource::collection($talks)]);
    }


    public function store(StoreTalkRequest $request)
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

        // Remove 'customer_ids' from validated data before creating the Talk
        unset($validatedData['customer_ids']);

        // Create a new Talk
        $talk = Talk::create($validatedData);

        // Attach validated customers (Many-to-Many)
        $talk->customers()->attach($validCustomerIds);

        // Return success response
        return $this->success('Talk created successfully', [
            'talk' => $talk->load('customers') // Load customers in response
        ], 201);
    }


    public function BookTalk(Request $request, $id)
    {
        $request->validate([
            'ticket_id' => 'required|unique:booking,ticket_id',
        ]);
        $talk = Talk::with(['event'])->findOrFail($id);
        $customer=Auth::user();
        if($customer->type=="customer"){
            if ($talk->capacity > 0) {
                $existingBooking = Book::where('talk_id', $talk->id)
                ->where('customer_id', Auth::id())
                ->exists();

            if ($existingBooking) {
                return $this->failure(__('You have already booked this talk'));
            }
            // Create booking
                // Generate unique booking reference
                $bookingReference = strtoupper(uniqid('REF-'));


                $booking = Book::create([
                    'event_id' => $talk->event->id ?? null,
                    'talk_id' => $talk->id,
                    'customer_id' => Auth::id(),
                    'status' => 'confirmed', // Mark as confirmed by default
                    'type' => 'talk',
                    'ticket_id' => $request->ticket_id,
                    'booked_at' => now(),
                    'event_date' => $talk->event->event_date ?? null,
                    'price' => $talk->price ?? 0, // Assuming talk has a price field
                    'booking_reference' => $bookingReference,
                ]);
                 // Generate QR Code containing ticket_id
            $qrCodePath = 'qrcodes/' . $request->ticket_id . '.png';
            $qrCode = QrCode::format('png')->size(200)->generate($booking->id);
            Storage::disk('public')->put($qrCodePath, $qrCode);

            // Decrease talk capacity
            $talk->update(['capacity' => $talk->capacity - 1]);

            return response()->json([
                'message' => 'Booking successful',

                'qr_code_url' => asset('storage/' . $qrCodePath), // URL to access the QR code
            ], 201);

            }
        }
        else{
            return $this->failure('You are not a customer may be speaker', 422);
        }



        return response()->json(['message' => 'No available capacity for this talk'], 400);
    }


}
