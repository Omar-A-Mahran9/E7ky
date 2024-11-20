<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;

class StoreAddonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return abilities()->contains('create_addonService');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name_ar" => ["required", "max:255", new NotNumbersOnly(), "unique:addon_services,name_ar"],
            "name_en" => ["required", "max:255", new NotNumbersOnly(), "unique:addon_services,name_en"],
            "price" => ["required"],        ];
    }
}
