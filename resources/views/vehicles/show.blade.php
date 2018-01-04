@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="mt-5">
            <h4 class="text-center">Vehicle Details</h4>
            <div class="row mt-5">
                <div class="col-12">
                    <ul>
                        <li><strong>Make: </strong>{{$vehicle->getMakeAndYear()}}</li>
                        <li><strong>License Number: </strong>{{$vehicle->license_number}}</li>
                        <li><strong>Chassis Number: </strong>{{$vehicle->chassis_number}}</li>
                        <li><strong>Driver: </strong>{{$vehicle->driver->fullName}}</li>
                        <li><strong>Added on: </strong>{{$vehicle->created_at->format('d/m/Y')}}</li>
                        <li><strong>No. of times booked: </strong>{{$vehicle->bookings_count}}</li>
                    </ul>
                    <h5>Routes</h5>
                    <ol>
                        @foreach($vehicle->locations as $route)
                            <li>{{$route->name}}</li>
                        @endforeach
                    </ol>
                </div>
            </div>
            @if($bookings->count())
                <div class="table-responsive">
                    <table class="table mt-5">
                        <tr>
                            <th>S/N</th>
                            <th>Date of Booking</th>
                            <th>Status</th>
                            <th>Pickup</th>
                            <th>Destination</th>
                            <th>Date(From)</th>
                            <th>Date(To)</th>
                        </tr>
                        @foreach($bookings as $index => $booking)
                            <tr>
                                <td>{{++$index}}</td>
                                <td>{{$booking->created_at->format('d/m/Y')}}</td>
                                <td>{{$booking->status}}</td>
                                <td>{{$booking->pickup->name}}</td>
                                <td>{{$booking->destination->name}}</td>
                                <td>{{$booking->from->format('d/m/Y')}}</td>
                                <td>{{$booking->to->format('d/m/Y')}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            @else
                <h3 class="text-center">No bookings yet <i class="fa fa-frown-o"></i></h3>
            @endif
        </div>
    </div>
@endsection