<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class StoreWorkshopsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return abilities()->contains('create_workshops');
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
            'location' => 'required|string|max:255',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'lat' => 'required|numeric|between:-90,90',
            'lon' => 'required|numeric|between:-180,180',
            'capacity' => 'required|integer|min:1',
            'event_id' => 'required',
            'day_id' => 'required',
            'customer_ids' => 'required|array', // Accept an array of customer IDs
            'customer_ids.*' => 'exists:customers,id' // Ensure each ID exists in the customers table

        ];
    }
}
