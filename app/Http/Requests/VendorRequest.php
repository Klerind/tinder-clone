<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorRequest extends FormRequest
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
            'vendorName' => 'required|string|max:300',
            'accountNo' => 'required|integer|max:3000000',
            'gstNo' => 'required|integer|max:30000000',
            'passport' => 'required|integer|max:30',
            'file' => 'required',
            'size' => 'required'
        ];
    }
}
