<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkshopsResource extends JsonResource
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
            'image' => $this->image,
            'name' => $this->name,
            'event_name' => $this->event->name,

            'location' => $this->location,
            'start_day' => $this->day->date,

            'capacity_total' => $this->capacity,
            'current_capacuty' => $this->capacity,

            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'description' => $this->description,
            'google_map_url' => "https://www.google.com/maps?q={$this->lat},{$this->lon}",
            'speakers' => CustomerResource::collection($this->customers)


        ];


        return $data;
    }
}
