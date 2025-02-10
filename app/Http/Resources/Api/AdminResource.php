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
            'facebook_link' => $this->facebook_link,
            'instagram_link' => $this->instagram_link,
            'X_link' => $this->X_link,
            'email' => $this->email,
            'job_description' => $this->job_description,
            'bio' => $this->bio,
            'image' => $this->image,
            'cover_picture' => $this->cover_picture ? url($this->cover_picture) : url('placeholder_images/default.svg'),
            'age' => (string) $this->age,
            'phone' => $this->phone,
            'gender' => $this->gender,
            'type' => $this->type,
            'otp' => $this->otp,
            'block_flag' => (int) $this->block_flag,
            'created_at' => $this->created_at->format('Y-m-d'),
            'updated_at' => $this->updated_at->format('Y-m-d'),
            'social_type' => $this->social_type,
            'social_id' => $this->social_id,
            'full_image_path' => $this->image ? url($this->image) : url('placeholder_images/default.svg'),
            'cover-picture' => $this->cover_picture ? url($this->cover_picture) : url('placeholder_images/default.svg'),
        ];
    }
}
