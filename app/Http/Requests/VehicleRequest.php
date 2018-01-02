<?php

namespace App\Http\Requests;

class VehicleRequest extends AuthRequest
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
            'license_number' => 'required|unique:vehicles,license_number' . $this->id,
            'chassis_number' => 'required|unique:vehicles,chassis_number' . $this->id,
            'year_of_manufacture' => 'required',
            'vehicle_model_id' => 'required|exists:vehicle_models,id'
        ];
    }
}
