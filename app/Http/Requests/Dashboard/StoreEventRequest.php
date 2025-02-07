<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return abilities()->contains('create_event');

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name_ar' => 'required|string|max:255|unique:events,name_ar',
            'name_en' => 'required|string|max:255|unique:events,name_en',
            'description_ar' => 'required|string',
            'description_en' => 'required|string',
            'event_map' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'featured' => 'boolean',
            'location' => 'required|string|max:255',
            'start_day' => 'required|date|after_or_equal:today',
            'is_multi_day' => 'boolean',

            'end_day' => 'required_if:is_multi_day,true|date|after_or_equal:start_day',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i|after:start_time',
            'registration_start_time' => 'nullable|date_format:H:i',
            'registration_end_time' => 'nullable||date_format:H:i|after:registration_start_time',
            'lat' => 'nullable|numeric|between:-90,90',
            'lon' => 'nullable|numeric|between:-180,180',
            'capacity' => 'nullable|integer|min:1',
            'status' => 'required|in:scheduled,ongoing,completed,canceled',
            'price' => 'nullable|numeric|min:0',
            'event_link' => 'nullable|url',
            'streaming_link' => 'nullable|url',
        ];
    }
}
