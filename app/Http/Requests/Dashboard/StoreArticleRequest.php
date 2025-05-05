<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
{
    public function authorize()
    {
        return true; // You can add authorization logic here
    }

    public function rules()
    {
        return [
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'description_ar' => 'required|string',
            'description_en' => 'required|string',
            'content_ar' => 'required|string',
            'content_en' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'slide_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'internal_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'video' => 'nullable|url',
            'status' => 'required|string|in:published,draft,archived',
            'category_id' => 'required|exists:categories,id',
            'schedule' => 'nullable|date',
            'is_slide_show' => 'nullable|boolean',
            'tag_id' => 'nullable|exists:tags,id',
        ];
    }
}
