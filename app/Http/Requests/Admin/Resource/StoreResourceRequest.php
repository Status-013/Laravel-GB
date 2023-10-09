<?php

namespace App\Http\Requests\Admin\Resource;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class StoreResourceRequest extends FormRequest
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
        $categoryTableName = (new Category())->getTable();

        return [
            'url' => ['required', 'url:https', 'unique:resources,url'],
            'category_id' => ["exists:{$categoryTableName},id", 'nullable']
        ];
    }

    public function attributes()
    {
        return [
            'category_id' => 'категория',
        ];
    }
}
