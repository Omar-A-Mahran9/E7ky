<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'image' => $this->full_image_path,
            'cover_picture' => $this->cover_picture,
            'phone' => $this->phone,
            'email' => $this->email,
            'otp'=>$this->otp,
            'name' => $this->first_name." ".$this->last_name,
            'job_description' => $this->job_description,
            'bio' => $this->bio,
            'count_talks' => $this->talks->count() ,
            // 'count_workshops' => $this->workshops->count(),
            'count_sessions_and_workshop' => $this->talks->count() ,
        ];
    }
}
