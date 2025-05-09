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
            'cover_picture' => $this->full_cover_picture ?? '',
            'birth_date' => $this->birth_date,
            'gender' => $this->gender,
            'status' => $this->status,

            'phone' => $this->phone,
            'email' => $this->email,
            'otp'=>$this->otp,
            'otp_expires_at'=>$this->otp_expires_at,
            "expires_in_seconds" => now()->diffInSeconds($this->otp_expires_at, false),
            'name' => $this->first_name." ".$this->last_name,
            'job_description' => $this->job_description,
            'bio' => $this->bio,
            'count_talks' => $this->talks->count() ,
            // 'count_workshops' => $this->workshops->count(),
            'count_sessions_and_workshop' => $this->talks->count() ,
        ];
    }
}
