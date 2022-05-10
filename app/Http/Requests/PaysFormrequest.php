<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaysFormrequest extends FormRequest
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
            'nomPays' => 'required|unique:pays,nomPays,'.$this->pay,
        ];
    }

    public function messages()
    {
        return [
            'nomPays.required' => 'Vous devez entrer le nom du pays',
            'nomPays.unique' => 'Cet pays existe déjà',
        ];
    }
}