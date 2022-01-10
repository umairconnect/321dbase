<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OperatorsRequest extends FormRequest
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
        $rules = [
            'opr_name' => 'required',
            'opr_mobile' => 'required|unique:operators',
            'opr_role_id' => 'required',
            'password' => 'required'
        ];

        if ($this->getMethod() == 'PUT') {
            // $rules['email'] = [
            //     'required',
            //     'email',
            //     Rule::unique('users')->ignore($this->operator)
            // ];

            $rules['opr_mobile'] = [
                'required',
                Rule::unique('operators')->ignore($this->operator)
            ];

            $rules['password'] = [
                'nullable',
                'confirmed'
            ];
        }

        return $rules;
    }
}
