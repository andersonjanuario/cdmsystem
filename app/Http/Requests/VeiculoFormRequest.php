<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VeiculoFormRequest extends FormRequest
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
            'descricao'          => 'required',
            'placa'        => 'required',
            'tipo'      => 'required',
            'apartamento_id'   => 'required',
        ];
    }
    
    public function messages()
    {
        return [
            'descricao.required' => 'O campo descrição é de preenchimento obrigatório!',
            'placa.required' => 'O campo placa é de preenchimento obrigatório!',            
            'tipo.required' => 'O campo tipo veiculo é de preenchimento obrigatório!',
            'apartamento_id.required' => 'O campo apartamento é de preenchimento obrigatório!'
        ];
    }
}
