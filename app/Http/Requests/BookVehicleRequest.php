<?php

namespace App\Http\Requests;

class BookVehicleRequest extends AuthRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return parent::authorize();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'pickup' => 'required|exists:locations,id',
            'destination' => 'required|exists:locations,id',
            'from_date' => 'required|date',
            'to_date' => 'required|date',
            'amount' => 'required|numeric',
            'card_name' => 'required',
            'card_number' => 'required|digits:16',
            'cvv' => 'required|digits:3',
            'expiry_month' => 'required',
            'expiry_year' => 'required'
        ];
    }
}
