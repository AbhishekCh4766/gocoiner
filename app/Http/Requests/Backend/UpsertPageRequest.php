<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class UpsertPageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //'active' => 'nullable|boolean',
            'title' => 'required|max:180',
            'slug' => 'sometimes|max:180',
            'page_type' => 'required|in:custom,post',
            'order' => 'nullable|integer',
        ];
    }
}