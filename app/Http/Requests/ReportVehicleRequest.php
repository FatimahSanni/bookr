<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class ReportVehicleRequest extends FormRequest
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
            'license_number' => 'required|exists:vehicles,license_number',
            'location' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'license_number.exists' => 'There is no vehicle with that plate/license number in our database'
        ];
    }
}
