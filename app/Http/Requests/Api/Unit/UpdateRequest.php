<?php

namespace App\Http\Requests\Api\Unit;

use App\Models\Unit;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public $unit;

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
        $this->unit = Unit::findOrFail($this->route()->parameter('unit'));
 
        return [
            'name' => 'required'
        ];
    }
}
