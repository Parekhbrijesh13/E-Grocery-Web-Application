<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class InventoryAdjustmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'type' => 'required|in:restock,return,reduce,damage,expired,set',
            'quantity' => 'required|integer|min:0',
            'low_stock_threshold' => 'nullable|integer|min:0',
            'reason' => 'nullable|string|max:120',
            'reference_no' => 'nullable|string|max:80',
            'notes' => 'nullable|string|max:500',
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator) {
                if ($this->type !== 'set' && (int) $this->quantity < 1) {
                    $validator->errors()->add('quantity', 'Quantity must be at least 1 for this adjustment.');
                }
            },
        ];
    }
}
