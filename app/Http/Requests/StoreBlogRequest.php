<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'array|nullable',
            'tags.*' => 'nullable|string|regex:/^[a-zA-Z0-9\-]+$/',
        ];
    }
}
