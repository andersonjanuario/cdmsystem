<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApartamentoFormRequest extends FormRequest
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
            'numero'          => 'required',
            'bloco'        => 'required',
            'bosque'      => 'required',
            'proprietario_id'   => 'required',
        ];
    }
    
    public function messages()
    {
        return [
            'numero.required' => 'O campo número é de preenchimento obrigatório!',
            'bloco.required' => 'O campo bloco é de preenchimento obrigatório!',            
            'bosque.required' => 'O campo bosque é de preenchimento obrigatório!',
            'proprietario_id.required' => 'O campo proprietário é de preenchimento obrigatório!'
        ];
    }
}
