<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = ['chassis_number', 'license_number', 'year_of_manufacture', 'vehicle_model_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vehicleModel()
    {
        return $this->belongsTo(VehicleModel::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function driver()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return string
     */
    public function getMakeAndYear()
    {
        return $this->vehicleModel->name . " " . $this->year_of_manufacture;
    }

    /**
     * @return mixed
     */
    public function getDriversPicture()
    {
        return $this->driver->userDetails->picture;
    }
}
