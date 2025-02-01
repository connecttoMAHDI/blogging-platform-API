<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBlogRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        // remove null and empty values
        $this->merge(
            array_filter(
                $this->all(),
                function ($value) {
                    return ! is_null($value) && $value !== '';
                }
            )
        );
    }

    public function rules(): array
    {
        return [
            'title' => 'sometimes|string',
            'content' => 'sometimes|string',
            'category_id' => 'sometimes|exists:categories,id',
            'tags' => 'array|sometimes',
            'tags.*' => 'sometimes|string|regex:/^[a-zA-Z0-9\-]+$/',
        ];
    }
}
