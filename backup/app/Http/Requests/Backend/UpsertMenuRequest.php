<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class UpsertMenuRequest extends FormRequest
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
            'name' => 'required|max:180',
            'parent_id' => 'nullable|integer|exists:menu_items,id',
            'page_id' => 'nullable|integer|exists:pages,id',
            'link' => 'nullable|url',
        ];
    }
}
