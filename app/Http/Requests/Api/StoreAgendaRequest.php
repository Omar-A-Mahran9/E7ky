<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreAgendaRequest extends FormRequest
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
            'name_ar' => 'required|string|max:255|unique:agenda,name_ar',
            'name_en' => 'required|string|max:255|unique:agenda,name_en',
            'description_ar' => 'required|string',
            'description_en' => 'required|string',
            'start_day' => 'required|date',
            'end_day' => 'nullable|date|after_or_equal:start_day',
            'start_time' => 'required|date_format:Y-m-d H:i:s',
            'end_time' => 'nullable|date_format:Y-m-d H:i:s|after:start_time',
            'event_id' => 'required|exists:events,id',
        ];
    }
}
