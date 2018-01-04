@extends('layouts.app')
@section('content')
    <div class="container">
        <h3 class="mt-5">Vehicle Listings</h3>
        <div class="mt-5 mb-5">
            {!! Form::open(['url' => '/vehicles', 'method' => 'GET']) !!}
            <div class="row mb-4">
                <div class="col-md-3">
                    {!! Form::label('pickup','PICKUP') !!}
                    {!! Form::select('from', $routes, null, ['class' =>'form-control', 'placeholder' => 'From', 'id'=>'search-pickup']) !!}
                </div>
                <div class="col-md-3">
                    {!! Form::label('destination','DESTINATION') !!}
                    {!! Form::select('to', $routes, null, ['class' =>'form-control', 'placeholder' => 'To', 'id'=>'search-destination']) !!}
                </div>
                <div class="col-md-3">
                    {!! Form::label('from_date', 'FROM DATE') !!}
                    {!! Form::date('from_date', null, ['class'=>'form-control', 'id'=>'search-from-date']) !!}
                </div>
                <div class="col-md-3">
                    {!! Form::label('to_date', 'TO DATE') !!}
                    {!! Form::date('to_date', null, ['class'=>'form-control', 'id'=>'search-to-date']) !!}
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-4">
                    {!! Form::label('sort_by','SORT BY') !!}
                    {!! Form::select('filters', $filters, null, ['class'=>'form-control', 'placeholder'=>'']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 col-xs-9">
                    <div class="form-group">
                        {{ Form::submit('Search', ['class' => 'btn btn-danger btn-block'] )  }}
                    </div>
                </div>
                <div class="col-md-2 col-xs-3">
                    <a href="/vehicles" class="btn btn-outline-info btn-block"><i class="fa fa-undo"></i></a>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        <div class="row">
            @forelse($vehicles as $vehicle)
                <div class="col-md-4">
                    <div class="card">
                        <img class="card-img-top" src="{{url($vehicle->getDriversPicture())}}" alt="Card image cap"
                             height="200px">
                        <div class="card-body">
                            <p class="card-text"><i
                                        class="fa fa-automobile"></i> {{$vehicle->getMakeAndYear()}}</p>
                            <p class="card-text"><i
                                        class="fa fa-line-chart"></i> {{$vehicle->bookings_count . " ".str_plural('time', $vehicle->bookings_count)}}
                            </p>
                            <a href="/vehicles/{{$vehicle->id}}" class="btn btn-outline-dark btn-block mb-3">View</a>
                            <a href="#" class="btn btn-info btn-block book-vehicle" data-toggle="modal"
                               data-target="#bookVehicleModal{{$vehicle->id}}">Book</a>
                        </div>
                    </div>
                    <br>
                </div>
                @include('vehicles._book_vehicle_form')
            @empty
                <h1 class="text-muted">No Vehicles available <i class="fa fa-frown-o"></i></h1>
            @endforelse
        </div>
    </div>
@endsection