<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $data = [];

        if (empty($this->slug) && !empty($this->product_name)) {
            $data['slug'] = Str::slug($this->product_name);
        }

        if ($this->has('save_draft')) {
            $data['status'] = 'draft';
        }

        if (!empty($data)) {
            $this->merge($data);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $product = $this->route('product');
        $productId = is_object($product) ? $product->getKey() : $product;

        return [
            'product_name' => 'required|string|max:100',
            'slug' => ['required', 'string', 'max:120', Rule::unique('products', 'slug')->ignore($productId)],
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'sku' => ['nullable', 'string', 'max:100', Rule::unique('products', 'sku')->ignore($productId)],
            'brand' => 'nullable|string|max:100',
            'mrp' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0|lte:mrp',
            'cost_price' => 'nullable|numeric|min:0',
            'tax' => 'required|numeric|in:0,5,12,18,28',
            'stock' => 'required|integer|min:0',
            'low_stock_threshold' => 'nullable|integer|min:0',
            'unit_value' => 'required|numeric|min:0.01',
            'unit' => 'required|in:kg,g,L,ml,pcs,dozen,pack',
            'images' => 'nullable|array|max:6',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'tags' => 'nullable|string|max:255',
            'status' => 'required|in:active,draft,inactive',
            'featured' => 'required|boolean',
            'cod' => 'required|boolean',
            'meta_title' => 'nullable|string|max:120',
            'meta_desc' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'product_name.required' => 'Product name is required.',
            'category_id.required' => 'Please select a category.',
            'category_id.exists' => 'Selected category is invalid.',
            'slug.unique' => 'Slug must be unique.',
            'sku.unique' => 'SKU must be unique.',
            'price.lte' => 'Selling price cannot be greater than MRP.',
            'images.*.image' => 'Each product image must be an image file.',
            'images.*.mimes' => 'Product images must be jpeg, png, jpg, gif, or webp.',
            'images.*.max' => 'Each product image cannot exceed 5MB.',
        ];
    }
}
