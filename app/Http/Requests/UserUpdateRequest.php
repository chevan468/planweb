<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserUpdateRequest extends Request
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
            'name'=> 'required|min:5',
            'lastName'=> 'required|min:5',
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'El nombre es obligatorio',
            'name.min'=>'El nombre debe contener al menos 5 caracteres',
            
            'lastName.required'=>'El apellido es obligatorio',
            'lastName.min'=>'El apellido debe contener al menos 5 caracteres',
            
            
        ];
    }
}
