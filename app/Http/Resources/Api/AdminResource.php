<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminResource extends JsonResource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            // 'facebook_link' => $this->facebook_link,
            // 'instagram_link' => $this->instagram_link,
            // 'X_link' => $this->X_link,
            'email' => $this->email,
            'job_description' => $this->job_description,
            'bio' => $this->bio,
            'image' => $this->full_image_path,
            'cover_picture' => $this->full_cover_picture ?? '',           'birth_date' => (string) $this->birth_date,
            'phone_code' => $this->phone_code,
            'phone' => $this->phone,
            'gender' => $this->gender,
            'type' => $this->type,
            'otp' => $this->otp,
            'block_flag' => (int) $this->block_flag,

            // 'social_type' => $this->social_type,
            // 'social_id' => $this->social_id,
            'full_image_path' => $this->full_image_path,
            'cover-picture' => $this->full_cover_picture ?? '',
        ];
    }
}
