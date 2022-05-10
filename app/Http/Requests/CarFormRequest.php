<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarFormRequest extends FormRequest
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
            'libelle' => 'required|unique:cars,libelle,'.$this->car,
            'nombreDePlace' => 'required',
            'categorie_id' => 'required',
            'user_id' => 'required' 
        ];
    }

    public function messages()
    {
        return [
            'libelle.required' => 'Vous devez entrer le libellé',
            'libelle.unique' => 'Cette libelle existe déjà',
            'nombreDePlace.required' => 'Vous devez entrer le nombre de place',
            'categorie_id.required' => 'Vous devez préciser la catégorie',
            'user_id.required' => 'L\'utilisateur est inconnu',
        ];
    }
}