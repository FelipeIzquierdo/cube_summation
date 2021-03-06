<?php

namespace App\Http\Requests\Cube;

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
            'cube.*.queries_number'  => 'integer|required|between:1,1000',
            'cube.*.last_coordinate' => 'required|integer|between:1,100'
        ];
    }
}
