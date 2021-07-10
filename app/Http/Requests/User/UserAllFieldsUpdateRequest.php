<?php

namespace App\Http\Requests\User;


use Illuminate\Foundation\Http\FormRequest;

class UserAllFieldsUpdateRequest extends FormRequest
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
            'email'                      => ["required","unique:users,email,{$this->id}","email"],
            'name'                       => 'required|string|min:3',
            'password'                   => 'nullable|confirmed|min:3'
        ];
    }
    public function prepareForValidation(){
        //
    }
}
