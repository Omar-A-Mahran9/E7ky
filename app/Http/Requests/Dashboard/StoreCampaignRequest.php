<?php
namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class StoreCampaignRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Ensure that the user is authorized to create a category
    }

    public function rules()
    {
        return [
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
          
            // 'meta_title' => 'nullable|string|max:255',
            // 'meta_description' => 'nullable|string',
            // 'meta_keywords' => 'nullable|string|max:255',
            'status' => 'required|in:0,1', // 0 = inactive, 1 = active
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'img_for_mob' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'sort' => 'nullable|integer',
            // 'html' => 'nullable|string',
        ];
    }
}
