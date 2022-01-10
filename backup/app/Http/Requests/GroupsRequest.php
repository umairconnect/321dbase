<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GroupsRequest extends FormRequest
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
            'gp_groupname' => 'required|unique:groups',
            'gp_status' => 'required',
            'gp_company' => 'required',
            'gp_wpp_group_id' => 'required',
            'gp_state' => 'required',
            'gp_city' => 'required',
            'gp_district' => 'required',
            'gp_address' => 'required',
            'gp_zip' => 'required',
            'gp_legal_name' => 'required',
            'gp_legal_id' => 'required',
            'password' => 'required'
        ];

        if ($this->getMethod() == 'PUT') {
            // $rules['email'] = [
            //     'nullable',
            //     'email',
            //     Rule::unique('users')->ignore($this->group->users()->whereRole('groupadmin')->first())
            // ];

            $rules['gp_groupname'] = [
                'required',
                Rule::unique('groups')->ignore($this->group)
            ];

            $rules['password'] = [
                'nullable',
                'confirmed'
            ];
        }

        return $rules;
    }
}
