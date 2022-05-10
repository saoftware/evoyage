<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VilleFormRequest extends FormRequest
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
            'nomVille' => 'required|unique:villes,nomVille,'.$this->ville,
            'pays_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nomVille.required' => 'Vous devez entrer le nom de la ville',
            'nomVille.unique' => 'Cette ville existe déjà',
            'pays_id.required' => 'Vous devez préciser le pays de la ville',
        ];
    }
}