<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCustomerRequest extends FormRequest
{
    public function authorize()
    {
        return abilities()->contains('update_customers');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $customer = $this->route('customer');

        return [
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:512',
            'cover_picture' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:1024',
            'first_name' => ['required', 'string', 'max:255', new NotNumbersOnly()],
            'last_name' => ['required', 'string', 'max:255', new NotNumbersOnly()],
            'phone' => ['required', 'string', 'regex:/^[0-9]+$/', 'max:20', Rule::unique('customers')->ignore($customer->id)],
            'email' => ['required', 'string', 'email:rfc,dns', Rule::unique('customers')->ignore($customer->id)],
            'job_description' => ['nullable', 'string'],
            'bio' => ['nullable', 'string'],
            'age' => ['nullable', 'integer', 'min:10', 'max:100'],
            'gender' => ['required', Rule::in(['male', 'female'])],
            'type' => ['required', 'in:speaker,customer'],
            'facebook_link' => ['nullable', 'url'],
            'instagram_link' => ['nullable', 'url'],
            'X_link' => ['nullable', 'url'],

            // Only require password if a new one is provided
            'password' => ['nullable', 'string', 'min:8', 'regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/'],
            'password_confirmation' => ['nullable', 'same:password'],
        ];
    }
}
