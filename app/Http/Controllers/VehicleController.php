<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleRequest;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\Vehicle;
use App\Models\VehicleModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $vehicles = Vehicle::query();
        $prices = Config::get('helpers.prices');
        if ($request->has('dateAsc')) {
            $vehicles = $vehicles->orderBy('created_at', 'DESC');
        }
        if ($request->has('dateAsc')) {
            $vehicles = $vehicles->orderBy('created_at', 'ASC');
        }
        $vehicles = $vehicles->paginate();
        return view('vehicles.index', compact('vehicles', 'prices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vehicleModels = VehicleModel::pluck('name', 'id');
        $years = Config::get('helpers.years');
        return view('vehicles.create', compact('vehicleModels', 'years'));
    }

    /**
     * @param VehicleRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            $result = DB::transaction(function () use ($request) {
                $user = new User();
                $user->name = $request->username;
                $user->email = $request->email;
                $user->password = Hash::make($request->username + 101);
                $user->save();
                $userDetail = new UserDetail();
                $userDetail->first_name = $request->first_name;
                $userDetail->last_name = $request->last_name;
                $userDetail->date_of_birth = Carbon::parse($request->date_of_birth);
                $userDetail->user_id = $user->id;
                $userDetail->picture = Storage::disk('public')->putFile('pictures', $request->picture);
                $userDetail->save();
                $vehicle = new Vehicle();
                $vehicle->license_number = $request->license_number;
                $vehicle->chassis_number = $request->chassis_number;
                $vehicle->year_of_manufacture = $request->year_of_manufacture;
                $vehicle->vehicle_model_id = $request->vehicle_model_id;
                $vehicle->driver_id = $user->id;
                $vehicle->save();
                return $vehicle->id;
            });
        } catch (\Exception $exception) {
            $result = false;
            Log::info($exception->getMessage());
        }
        return $result ? redirect('/vehicles/' . $result) : redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehicle $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        return view('vehicles.show', compact('vehicle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vehicle $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle $vehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Vehicle $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehicle $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        //
    }
}
