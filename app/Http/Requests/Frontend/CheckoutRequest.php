<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'fullname' => ['required', 'max:255'],
            'address' => ['required', 'max:255'],
            'phone' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'note' => ['required', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'email' => 'Email không hợp lệ',
            'required' => 'Vui lòng nhập',
            'size' => 'Không được quá :max kí tự',

        ];
    }
}
