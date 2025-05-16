<?php

namespace App\Http\Resources\Api;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class TalkResource extends JsonResource
{
    protected $detailed;

    // Accept the detailed flag in the constructor
    public function __construct($resource, $detailed = false)
    {
        parent::__construct($resource);
        $this->detailed = $detailed;
    }

    public function toArray(Request $request): array
    {
        // Common fields for both list and view
        $data = [
            'id' => $this->id,
            'image' => $this->full_image_path,
            'name' => $this->name,
            'event_name' => $this->event->name,
            'is_book' => Auth::check() && Book::where('talk_id', $this->id)
                                                        ->where('customer_id', Auth::id())
                                                        ->exists(),

            'location' => $this->location,
            'start_day' => $this->day->date,
            'capacity_total' => $this->capacity,
            'current_capacuty' => $this->capacity,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'description' => $this->description,
            'image_map_url' => "https://www.google.com/maps?q={$this->lat},{$this->lon}",
            'speakers' => CustomerResource::collection($this->customers)
        ];

        return $data;
    }
}
