<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportVehicleRequest;
use App\Models\IncidenceReport;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Auth;

class IncidenceReportController extends Controller
{
    /**
     * @param ReportVehicleRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function reportVehicle(ReportVehicleRequest $request)
    {
        $vehicle = Vehicle::where('license_number', $request->license_number)->first();
        $incidenceReport = new IncidenceReport();
        $incidenceReport->vehicle_id = $vehicle->id;
        $incidenceReport->reporter_id = Auth::user() ? Auth::user()->id : null;
        $incidenceReport->collision = $request->collision ? 1 : 0;
        $incidenceReport->injury = $request->injury ? 1 : 0;
        $incidenceReport->location = $request->location;
        $incidenceReport->comment = $request->comment ?: null;
        return $incidenceReport->save() ? response()->json("Thanks for the report. It has been forwarded to our investigations department ") : response()->json("Something went wrong. Please try again");
    }
}
