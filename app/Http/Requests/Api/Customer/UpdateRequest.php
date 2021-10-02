<?php

namespace App\Http\Requests\Api\Customer;

use App\Models\Customer;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public $customer;
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
        $this->customer = Customer::findOrFail($this->route()->parameter('customer'));

        return [
            'name' => 'required',
            'address' => 'required',
            'contact' => 'required|numeric|digits_between:9,14',
            'email' => 'required|email',
            'discount_id' => 'nullable|exists:discounts,id',
            'image' => 'nullable|mimes:jpg,png,jpeg|max:1024'
        ];
    }
}
