<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryStoreRequest extends FormRequest
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
        // dd($this);
        return [
            'name' => ['required', 'unique:categories,name' . $routeName === 'admin.category.update' ? $this->id : ''],
            'show_at_home' => ['required', 'boolean'],
            'status' => ['required', 'boolean'],
        ];
    }
    public function messages(): array
    {
        return [
            'required' => 'Vui lòng nhập',
            'boolean' => 'Vui lòng chọn',
            'unique' => 'Đã tồn tại'
        ];
    }
}
