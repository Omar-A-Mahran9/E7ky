<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEventRequest extends FormRequest
{
    public function authorize(): bool
    {
        return abilities()->contains('update_event');
    }

    public function rules()
    {
        $eventId = $this->route('event')->id;

        return [
            'name_ar' => ['required', Rule::unique('events', 'name_ar')->ignore($eventId)],
            'name_en' => ['required', Rule::unique('events', 'name_en')->ignore($eventId)],
            'description_ar' => ['nullable', 'string'],
            'description_en' => ['nullable', 'string'],
            'start_day' => ['required', 'date'],
            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['required', 'date_format:H:i'],
            'registration_start_time' => ['required', 'date_format:H:i'],
            'registration_end_time' => ['required', 'date_format:H:i'],
            'capacity' => ['nullable', 'integer'],
            'price' => ['nullable', 'numeric'],
            'event_link' => ['nullable', 'url'],
            'streaming_link' => ['nullable', 'url'],
            'image' => ['nullable', 'image'],
            'event_map' => ['nullable', 'image'],
            'location' => ['nullable', 'string'],
            'lat' => ['nullable', 'numeric'],
            'lon' => ['nullable', 'numeric'],
            'status' => ['required', 'in:scheduled,cancelled,completed'],
            'featured' => ['boolean'],
        ];
    }

    protected function prepareForValidation()
        {
            foreach (['start_time', 'end_time', 'registration_start_time', 'registration_end_time'] as $field) {
                if ($this->filled($field)) {
                    try {
                        $this->merge([
                            $field => \Carbon\Carbon::parse($this->input($field))->format('H:i'),
                        ]);
                    } catch (\Exception $e) {
                        // Let the validator handle incorrect formats
                    }
                }
            }
        }

}
