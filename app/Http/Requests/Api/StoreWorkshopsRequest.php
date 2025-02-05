<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreWorkshopsRequest extends FormRequest
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
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'description_ar' => 'required|string',
            'description_en' => 'required|string',
            'location' => 'required|string',
            'start_time' => 'required|date',
            'end_time' => 'nullable|date|after:start_time',
            'agenda_id' => 'required|exists:agenda,id',

            'event_id' => 'required|exists:events,id',
            'customer_id' => 'required|exists:customers,id,type,speaker', // Ensure customer_id is of type speaker
        ];
    }
}
