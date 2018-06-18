<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ServiceUpdateRequest extends Request
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
            'description'=> 'required|min:5',
            'price'=> 'numeric|required|min:1',
            'contactNumber'=> 'required|min:10000000|max:99999999|numeric',
            'contactEmail'=> 'required|email',
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'El nombre es obligatorio',
            'name.min'=>'El nombre debe contener al menos 5 caracteres',
            
            'description.required'=>'El servicio es obligatorio',
            'description.min'=>'La descripción debe contener al menos 5 caracteres',
            
            'price.required'=>'El precio es obligatorio',
            'price.numeric'=>'Solo debe contener números',
            'price.min'=>'Debe ingresar un monto',
            
            'contactNumber.required'=>'El teléfono es obligatorio',
            'contactNumber.min'=>'Debe tener 8 dígitos',
            'contactNumber.max'=>'Debe tener 8 dígitos',
            'contactNumber.numeric'=>'Solo debe contener números',
            
            'contactEmail.required'=>'El correo es obligatorio',
            'contactEmail.email'=>'Formato de correo incorrecto',
            
        ];
    }
}
