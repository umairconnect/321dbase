<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UsersRequest extends FormRequest
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
            'usr_firstname' => 'required',
            'usr_fullname' => 'required',
            'usr_mobile' => 'required|unique:users',
            'password' => 'required',
            'usr_dob' => 'required'
        ];

        if ($this->getMethod() == 'PUT') {
            // $rules['email'] = [
            //     'required',
            //     'email',
            //     Rule::unique('users')->ignore($this->user)
            // ];

            $rules['usr_mobile'] = [
                'required',
                Rule::unique('users')->ignore($this->user)
            ];

            $rules['password'] = [
                'nullable',
                'confirmed'
            ];
        }

        return $rules;
    }
}
