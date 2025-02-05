<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TalkResource extends JsonResource
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
        ];


        return $data;
    }
}
