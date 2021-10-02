<?php

namespace App\Http\Requests\Api\Discount;

use App\Models\Discount;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public $discount;
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
        $this->discount = Discount::findOrFail($this->route()->parameter('discount'));

        return [
            'amount' => 'required',
            'type' => 'required|in:fix,persentase',
            'is_active' => 'required|boolean'
        ];
    }
}
