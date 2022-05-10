<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends FormRequest
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
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required|unique:users,email,'.$this->user,
            'telephone' => 'required',
            'pasword' => 'required|min:6',
        ];
    }

    public function messages()
    {
        return [
            'nom.required' => 'Vous devez préciser le nom',
            'prenom.required' => 'Vous devez préciser le prénom',
            'telephone.required' => 'Vous devez préciser le téléphone',
            'email.required' => 'Vous devez entrer l\'adresse mail',
            'email.unique' => 'Cette ville existe déjà',
            'password.required' => 'Vous devez préciser le mot de passe',
            'password.min' => 'Vous devez entrer au moins 6 caractères pour le mot de passe',
        ];
    }
}