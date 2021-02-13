<?php


namespace App\Http\Requests;


class ParcelFormRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'description' => 'required',
            'date' => 'required',
            'cost' => 'required|string|min:2|max:10',
            'starting_adresse' => 'required',
            'destination_adresse' => 'required',
        ];
    }
}
