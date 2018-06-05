<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProductCreateRequest extends Request
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
            'name' => 'required|min:3|unique:products,name',
            'price'=> 'required',
            'marks_id' => 'required|not_in:0',
        ];
    }

    public function messages()
    {
        return [
            'marks_id.not_in' => 'El campo Marca es obligatorio',
            'name.required'=>'El campo Marca es obligatorio',
            'name.min:3'=>'Debe contener más de 3 caractéres!',
            'name.unique'=>'El registro ya existe!',
        ];
    }
}
