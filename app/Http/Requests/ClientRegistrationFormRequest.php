<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Config;
class ClientRegistrationFormRequest extends FormRequest
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
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string|min: '.Config::get('constants.MIN_PASSWORD_LENGTH').' |max:10',
            'role' => 'required|in:0,1,2',
             'cin' =>'required',
            'phone_number' =>'required',
        ];
    }
}
