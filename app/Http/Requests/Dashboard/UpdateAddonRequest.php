<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAddonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return abilities()->contains('update_addonService');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $addon = request()->route('addon');

        return [
            "name_ar" => [
                "required",
                "string",
                "max:255",
                Rule::unique('addon_services', 'name_ar')->ignore($addon->id),
                new NotNumbersOnly(),
            ],
            "name_en" => [
                "required",
                "string",
                "max:255",
                Rule::unique('addon_services', 'name_en')->ignore($addon->id),
                new NotNumbersOnly(),
            ],
            "price" => ["required", "numeric"],
        ];
    }
}
