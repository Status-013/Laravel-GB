<?php

namespace App\Http\Requests\Admin\News;

use App\Enums\News\Status;
use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreNewsRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $categoryTableName = (new Category())->getTable();

        return [
            'title' => ['required', 'string', 'min:5', 'max:100'],
            'image' => ['nullable', 'image'],
            'content' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'category_id' => ['required', "exists:{$categoryTableName},id"],
            'status' => ['required', new Enum(Status::class)],
            'author' => ['required', 'string']
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'заголовок',
            'content' => 'текст новости (контент)',
            'category_id' => 'категория',
            'status' => 'статус',
            'author' => 'автор'
        ];
    }
}
