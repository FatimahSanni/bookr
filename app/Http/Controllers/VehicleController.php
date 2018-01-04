<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookVehicleRequest;
use App\Http\Requests\VehicleRequest;
use App\Models\Booking;
use App\Models\Location;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\Vehicle;
use App\Models\VehicleModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $routes = Location::pluck('name', 'id');
        $filters = Config::get('helpers.filters');
        $months = Config::get('helpers.months');
        $expiryYearsForCreditCards = Config::get('helpers.expiryYearsForCreditCards');
        $bookedVehicles = collect([]);
        if (is_null($request->from) && is_null($request->to) && is_null($request->filters) && is_null($request->date)) {
            $vehicles = $vehicles->orderBy('created_at', 'DESC');
        }
        if (!is_null($request->from) && !is_null($request->to)) {
            $from = $request->from;
            $to = $request->to;
            $vehicles = $vehicles->whereHas('locations', function ($query) use ($from, $to) {
                $query->where('locations.id', $from)->orWhere('locations.id', $to);
            });
        }
        if ($request->filters === "dateAsc") {
            $vehicles = $vehicles->orderBy('created_at', 'asc');
        }

        if ($request->filters === "dateDesc") {
            $vehicles = $vehicles->orderBy('created_at', 'desc');
        }
        if ($request->filters === "bookingsAsc") {
            $vehicles = $vehicles->withCount('bookings')->orderBy('bookings_count', 'asc');
        }
        if ($request->filters === "bookingsDesc") {
            $vehicles = $vehicles->withCount('bookings')->orderBy('bookings_count', 'desc');
        }
        if (!is_null($request->from_date) && !is_null($request->to_date)) {
            $from_date = $request->from_date;
            $to_date = $request->to_date;
            $bookedVehicles = Vehicle::whereHas('bookings', function ($query) use ($from_date, $to_date) {
                return $query->where('to', '=', $from_date)
                    ->orWhere(function ($query) use ($from_date, $to_date) {
                        return $query->where('from', '<=', $from_date)
                            ->where('to', '=', $to_date);
                    })
                    ->orWhere(function ($query) use ($from_date, $to_date) {
                        return $query->where('from', '<=', $from_date)
                            ->where('to', '>=', $to_date);
                    })
                    ->orWhere(function ($query) use ($from_date, $to_date) {
                        return $query->where('from', '>=', $from_date)
                            ->where('from', '<=', $to_date);
                    })
                    ->orWhere(function ($query) use ($from_date, $to_date) {
                        return $query->where('from', '=', $from_date)
                            ->where('to', '=', $to_date);
                    })
                    ->orWhere(function ($query) use ($from_date, $to_date) {
                        return $query->where('from', '=', $to_date)
                            ->where('to', '>=', $to_date);
                    });
            })->get();
        }
        $vehicles = $bookedVehicles ? $vehicles->get()->diff($bookedVehicles) : $vehicles->get();
        return view('vehicles.index', compact('vehicles', 'prices', 'routes', 'filters', 'expiryYearsForCreditCards', 'months'));
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
        $routes = Location::pluck('name', 'id');
        return view('vehicles.create', compact('vehicleModels', 'years', 'routes'));
    }

    /**
     * @param VehicleRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(VehicleRequest $request)
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
                $vehicle->locations()->sync($request->routes);
                return $vehicle->id;
            });
        } catch (\Exception $exception) {
            $result = false;
            Log::info($exception->getMessage());
        }
        if ($result) {
            notify()->flash("<i class='fa-thumbs-up'></i>", "success", ['text' => 'Vehicle successfully added']);
            return redirect('/vehicles/' . $result);
        } else {
            notify()->flash("<i class='fa-frown-o'></i>", "danger", ['text' => "Something happened. Vehicle could not be happened. Please try again"]);
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehicle $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        $bookings = Booking::where('vehicle_id', $vehicle->id)->orderBy('from', 'asc')->get();
        return view('vehicles.show', compact('vehicle', 'bookings'));
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

    /**
     * @param BookVehicleRequest $request
     * @param $vehicleId
     * @return \Illuminate\Http\JsonResponse
     */
    public function bookVehicle(BookVehicleRequest $request, $vehicleId)
    {
        $booking = new Booking();
        $booking->vehicle_id = $vehicleId;
        $booking->client_id = Auth::user()->id;
        $booking->pickup_id = $request->pickup;
        $booking->destination_id = $request->destination;
        $booking->from = $request->from_date;
        $booking->to = $request->to_date;
        $booking->amount = $request->amount;
        return $booking->save() ? response()->json("Vehicle successfully booked") : response()->json("Something went wrong. Vehicle could not be booked. Please try again");
    }

}
