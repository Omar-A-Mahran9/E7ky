<?php

namespace App\Http\Requests\Dashboard;

use App\Models\Customer;
use App\Rules\ExistButDeleted;
use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:512',
            'cover_picture' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:1024',
            'first_name' => ['required', 'string', 'max:255', new NotNumbersOnly()],
            'last_name' => ['required', 'string', 'max:255', new NotNumbersOnly()],
            'facebook_link' => ['nullable', 'url'],
            'instagram_link' => ['nullable', 'url'],
            'X_link' => ['nullable', 'url'],
            'job_description' => ['nullable', 'string'],
            'bio' => ['nullable', 'string'],
            'age' => ['nullable', 'integer', 'min:10', 'max:100'],
            'phone' => ['required', 'string', 'regex:/^[0-9]+$/', 'max:20', 'unique:customers'],
            'email' => ['required', 'string', 'email:rfc,dns', 'unique:customers'],
            'gender' => ['nullable', Rule::in(['male', 'female'])],

            'type' => ['required', 'in:speaker,customer'],
            'password' => ['required', 'string', 'min:8', 'regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/'],
            'password_confirmation' => ['required','same:password'],
        ];
    }
}
