<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        if (empty($this->slug) && !empty($this->category_name)) {
            $this->merge([
                'slug' => \Illuminate\Support\Str::slug($this->category_name)
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category_name' => 'required|string|max:50',
            'slug'=> 'required|string|max:50|unique:categories,slug',
            'emoji'=> 'nullable|string|max:10',
            'category_img'=> 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description'=> 'nullable|string|max:100',
            'status'=> 'required|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'category_name.required' => 'Category name is required.',
            'category_name.string' => 'Category name must be a string.',
            'category_name.max' => 'Category name cannot exceed 50 characters.',
            'slug.required' => 'Slug is required.',
            'slug.string' => 'Slug must be a string.',
            'slug.max' => 'Slug cannot exceed 50 characters.',
            'slug.unique' => 'Slug must be unique.',
            'emoji.string' => 'Emoji must be a string.',
            'emoji.max' => 'Emoji cannot exceed 10 characters.',
            'category_img.image' => 'Category image must be an image file.',
            'category_img.mimes' => 'Category image must be a file of type: jpeg, png, jpg, gif.',
            'category_img.max' => 'Category image cannot exceed 2MB.',
            'description.string' => 'Description must be a string.',
            'description.max' => 'Description cannot exceed 100 characters.',
            'status.required' => 'Status is required.',
            'status.boolean' => 'Status must be true or false.',
        ];
    }

}
