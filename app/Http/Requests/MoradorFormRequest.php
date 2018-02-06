<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MoradorFormRequest extends FormRequest
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
            'nome'          => 'required',
            'inquilino'        => 'required',
            'status'      => 'required',
            'apartamento_id'   => 'required',
            'parentesco_id'   => 'required',
        ];
    }
    
    public function messages()
    {
        return [
            'nome.required' => 'O campo nome é de preenchimento obrigatório!',
            'inquilino.required' => 'O campo inquilino é de preenchimento obrigatório!',            
            'status.required' => 'O campo status veiculo é de preenchimento obrigatório!',
            'apartamento_id.required' => 'O campo apartamento é de preenchimento obrigatório!',
            'parentesco_id.required' => 'O campo parentesco é de preenchimento obrigatório!'
        ];
    }
}
   
