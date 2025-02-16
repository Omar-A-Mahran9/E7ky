<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
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
            'location' => $this->location,
            'price' => $this->price,
            'start_day' => $this->start_day,
            'start_time' => $this->start_time,
            'favorite' => true,
            'description' => $this->description,
            'google_map_url' => "https://www.google.com/maps?q={$this->lat},{$this->lon}",
            'event_link' => $this->event_link,
            'streaming_link' => $this->streaming_link,
            'event_map' => $this->full_event_map,
             'talks' => $this->talks->count(),
             'workshops' => $this->workshops->count(),
             'is_live'=>true,
        ];


        return $data;
    }
}
