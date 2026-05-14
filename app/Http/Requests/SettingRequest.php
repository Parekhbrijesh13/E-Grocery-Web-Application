<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'site_name' => 'required|string|max:255',
            'site_logo' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'favicon' => 'nullable|image|mimes:jpeg,png,jpg,webp,ico|max:1024',
            'support_email' => 'nullable|email|max:255',
            'support_phone' => 'nullable|string|max:50',
            'store_address' => 'nullable|string',
            'currency_symbol' => 'nullable|string|max:10',
            'tax_rate' => 'nullable|numeric|min:0|max:100',
            'facebook_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
        ];
    }
}
