<?php

namespace App\Http\Requests\Api\Item;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'name' => 'required',
            'stock' => 'required|numeric',
            'price' => 'required|numeric',
            'unit_id' => 'required|exists:units,id',
            'image' => 'required|mimes:jpg,png,jpeg|max:1024'
        ];
    }
}
