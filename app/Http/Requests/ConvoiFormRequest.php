<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConvoiFormRequest extends FormRequest
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
            'villeDepart_id' => 'required',
            'villeArrivee_id' => 'required',
            'car_id' => 'required',
            'horaire_id' => 'required',
            'user_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'villeDepart_id.required' => 'Vous devez préciser la ville de départ',
            'car_id.required' => 'Vous devez préciser le car',
            'villeArrivee_id.required' => 'Vous devez préciser la ville d\'arrivée',
            'horaire_id.required' => 'Vous devez préciser l\'heure du convoi',
            'user_id.required' => 'L\'utilisateur es inconnu',
        ];
    }
}