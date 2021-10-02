<?php

namespace App\Http\Requests\Api\Sales;

use App\Models\Sales;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public $sales;
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
        $this->sales = Sales::findOrFail($this->route()->parameter('sale'));

        return [
            'items.*' => 'required',
            'customer_id' => 'required'
        ];
    }
}
