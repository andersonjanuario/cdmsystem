<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProprietarioFormRequest extends FormRequest
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
            'nome'          => 'required|min:3|max:100',
            'cpf'        => 'required|numeric',
            'adimplente'      => 'required',
            'morador'   => 'required',
        ];
    }
    
    public function messages()
    {
        return [
            'nome.required' => 'O campo nome é de preenchimento obrigatório!',
            'cpf.numeric' => 'Precisa ser apenas números!',
            'cpf.required' => 'O campo cpf é de preenchimento obrigatório!',
            'adimplente.required' => 'O campo adimplente é de preenchimento obrigatório!',
            'morador.required' => 'O campo morador é de preenchimento obrigatório!'
        ];
    }
}
