<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return ['id' => $this->id,
                    'image' => $this->image,
                    'event_map' => $this->event_map,
                    'name_ar' => $this->name_ar,
                    'name_en' => $this->name_en,
                    'description_ar' => $this->description_ar,
                    'description_en' => $this->description_en,
                    'is_multi_day' => $this->is_multi_day,
                    'start_day' => $this->start_day,
                    'end_day' => $this->end_day,
                    'start_time' => $this->start_time,
                    'end_time' => $this->end_time,
                    'registration_start_time' => $this->registration_start_time,
                    'registration_end_time' => $this->registration_end_time,
                    'lat' => $this->lat,
                    'lon' => $this->lon,
                    'capacity' => $this->capacity,
                    'status' => $this->status,
                    'price' => $this->price,
                    'event_link' => $this->event_link,
                    'streaming_link' => $this->streaming_link,
                    'created_at' => $this->created_at->toDateTimeString(),
                    'updated_at' => $this->updated_at->toDateTimeString(),];
    }
}
