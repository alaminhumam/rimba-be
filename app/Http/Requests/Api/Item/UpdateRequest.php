<?php

namespace App\Http\Requests\Api\Item;

use App\Models\Item;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public $item;
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
        $this->item = Item::findOrFail($this->route()->parameter('item'));

        return [
            'name' => 'required',
            'stock' => 'required|numeric',
            'price' => 'required|numeric',
            'unit_id' => 'required|exists:units,id',
            'image' => 'nullable|mimes:jpg,png,jpeg|max:1024'
        ];
    }
}
