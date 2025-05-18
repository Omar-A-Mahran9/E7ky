<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
  public function toArray($request)
    {
        return [
            'id'                 => $this->id,
            'name'            => $this->name,
            'description'     => $this->description,
            'image'              => $this->full_image_path, // Optional accessor
            'mobile_image'              => $this->full_img_for_mob_path, // Optional accessor
             'created_at'         => $this->created_at?->toDateTimeString(),
        ];
    }
}
