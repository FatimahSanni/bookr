@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <h5 class="card-header">{{$vehicle->getMakeAndYear()}}</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-7">
                        <ul>
                            <li><strong>License Number: </strong>{{$vehicle->license_number}}</li>
                            <li><strong>Chassis Number: </strong>{{$vehicle->chassis_number}}</li>
                            <li><strong>Driver: </strong>{{$vehicle->driver->fullName}}</li>
                            <li><strong>Added on: </strong>{{$vehicle->created_at->format('d/m/y')}}</li>
                        </ul>
                    </div>
                    <div class="col-5">
                        <img src="{{url($vehicle->getDriversPicture())}}" class="img-fluid rounded"
                             alt="Driver's picture" width="120px">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h5>Routes</h5>
                        <ol>
                            @foreach($vehicle->locations as $route)
                                <li>{{$route->name}}</li>
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <h4>Customer Reviews</h4>
    </div>
@endsection