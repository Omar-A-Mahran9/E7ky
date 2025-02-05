<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TalkersResource extends JsonResource
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
            'cover_picture' => $this->cover_picture,
            'name' => $this->first_name." ".$this->last_name,
            'job_description' => $this->job_description,
            'bio' => $this->bio,
            'count_talks' => $this->talks->count() ,
            // 'count_workshops' => $this->workshops->count(),
            'count_sessions_and_workshop' => $this->talks->count() ,


        ];

        // If detailed flag is true, include more detailed information
        if ($this->detailed) {

            $data = array_merge($data, [
 // Here, modify the talks data as requested
                'talks' => $this->talks->map(function ($talk) {
                    return [
                        'name' => $talk->name,
                        'image' => $talk->full_image_path,
                        'google_map_url' => "https://www.google.com/maps?q={$this->lat},{$this->lon}",
                        'location' => $talk->location,
                        'event' => $talk->event->name,
                        'start_time' => $talk->agenda->start_time,
                    ];
                }),

                'workshops' => $this->talks->map(function ($talk) {
                    return [
                        'name' => $talk->name,
                        'image' => $talk->full_image_path,
                        'google_map_url' => "https://www.google.com/maps?q={$this->lat},{$this->lon}",
                        'location' => $talk->location,
                        'event' => $talk->event->name,
                        'start_time' => $talk->agenda->start_time,
                    ];
                }),

            ]);
        }

        return $data;
    }
}
