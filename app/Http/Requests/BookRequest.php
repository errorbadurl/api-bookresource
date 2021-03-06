<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'title' => 'required|max:191',
            'description' => 'required|string',
            'author_first_name' => 'required|string',
            'author_last_name' => 'required|string',
            'price' => 'required|between:0,99.99',
            'stock' => 'required|integer|min:0|max:100',
        ];
    }
}
