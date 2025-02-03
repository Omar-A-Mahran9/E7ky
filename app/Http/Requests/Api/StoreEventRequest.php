<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'image' => 'required|string',
            'event_map' => 'required|string',
            'name_ar' => 'required|string|unique:events,name_ar',
            'name_en' => 'required|string|unique:events,name_en',
            'description_ar' => 'required|string',
            'description_en' => 'required|string',
            'is_multi_day' => 'boolean',
            'start_day' => 'required|date',
            'end_day' => 'nullable|date|after_or_equal:start_day',
            'start_time' => 'required|date_format:Y-m-d H:i:s',
            'end_time' => 'nullable|date_format:Y-m-d H:i:s|after:start_time',
            'registration_start_time' => 'nullable|date_format:Y-m-d H:i:s',
            'registration_end_time' => 'nullable|date_format:Y-m-d H:i:s|after:registration_start_time',
            'lat' => 'nullable|numeric',
            'lon' => 'nullable|numeric',
            'capacity' => 'nullable|integer|min:1',
            'status' => 'required|in:scheduled,ongoing,completed,canceled',
            'price' => 'nullable|numeric|min:0',
            'event_link' => 'nullable|url',
            'streaming_link' => 'nullable|url',
        ];
    }
}
