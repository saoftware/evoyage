<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BilletFormRequest extends FormRequest
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
            'prix' => 'required',
            'convoi_id' => 'required',
            'user_id' => 'required' 
        ];
    }

    public function messages()
    {
        return [
            'prix.required' => 'Vous devez entrer le prix',
            'convoi_id.required' => 'Vous devez préciser le convoi',
            'user_id.required' => 'L\'utilisateur est inconnu',
        ];
    }
}