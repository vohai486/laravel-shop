<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CouponStoreRequest extends FormRequest
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
            'name' => ['required', 'max:255'],
            'code' => ['required', 'max:50'],
            'qty' => ['required', 'integer'],
            'min_purchase_amount' => ['required', 'integer'],
            'expire_date' => ['required', 'date'],
            'discount_type' => ['required'],
            'discount' => ['required'],
            'status' => ['required', 'boolean']
        ];
    }
    public function messages(): array
    {
        return [
            'required' => 'Vui lòng nhập',
            'size' => 'Không được quá :max kí tự',
            'integer' => 'Phải là số nguyên',
            'boolean' => 'Vui lòng chọn',
        ];
    }

}
