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
            'start_day' => $this->agenda->start_day,

            'start_time' => $this->start_time,
            'end_time' => $this->end_time,

        ];
        if ($this->detailed) {
            $data = array_merge($data, [
                'description' => $this->description,
                'google_map_url' => "https://www.google.com/maps?q={$this->lat},{$this->lon}",
                 'speakers' => $this->customers->map(function ($customer) {
                     return [
                         'name' => $customer->first_name . " " . $customer->last_name,
                         'image' => $customer->full_image_path,

                         'start_time' => "10:00",
                         'end_time' => "10:00",

                     ];
                 }),


            ]);
        }

        return $data;
    }
}
