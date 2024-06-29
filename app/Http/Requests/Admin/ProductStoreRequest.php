<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
        $routeName = $this->route()->getName();
        return [
            'image' => [$routeName === 'admin.product.store' ? 'required' : 'nullable', 'image', 'max:3000'],
            'name' => ['required', 'max:255'],
            'category_id' => ['required', 'integer'],
            'price' => ['required', 'numeric'],
            'short_description' => ['required', 'max:500'],
            'long_description' => ['required'],
            'sku' => ['nullable', 'max:255'],
            'seo_title' => ['nullable', 'max:255'],
            'seo_description' => ['nullable', 'max:255'],
            'show_at_home' => ['required', 'boolean'],
            'status' => ['required', 'boolean']
        ];
    }

    public function messages(): array
    {
        return [
            'image' => 'Vui lòng chọn ảnh',
            'required' => 'Vui lòng nhập',
            'size' => 'Không được quá :max kí tự',
            'integer' => 'Phải là số nguyên',
            'numeric' => 'Phải là số',
            'boolean' => 'Vui lòng chọn',
            'unique' => 'Đã tồn tại'
        ];
    }
}
