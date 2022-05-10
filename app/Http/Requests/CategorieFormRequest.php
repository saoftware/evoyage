<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategorieFormRequest extends FormRequest
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
            'libelle' => 'required|unique:categories,libelle,'.$this->categorie,
        ];
    }

    public function messages()
    {
        return [
            'libelle.required' => 'Vous devez entrer le titre de la catégorie',
            'libelle.unique' => 'Cette catégorie existe déjà',
        ];
    }
}