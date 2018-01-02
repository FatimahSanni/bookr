@extends('layouts.app')
@section('content')
    <div class="container">
        <h3>Vehicle Listings</h3>
        <div class="mt-5 mb-5">
            {!! Form::open(['url' => '/vehicles', 'method' => 'GET']) !!}
            <div class="row">
                <div class="col-5">
                    {!! Form::select('from', [], null, ['class' =>'form-control', 'placeholder' => 'From']) !!}
                </div>
                <div class="col-5">
                    {!! Form::select('to', [], null, ['class' =>'form-control', 'placeholder' => 'To']) !!}
                </div>
                <div class="col-2">
                    {{ Form::button('Search', ['class' => 'btn btn-info'] )  }}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        <div class="row">
            <div class="col-12">
                <p>
                    <strong class="small">SORT BY:</strong>
                    <a href="?dateDesc" class="small text-info">Newest</a> |
                    <a href="?bookingsAsc" class="small text-info">Bookings (Low to High)</a> |
                    <a href="?bookingsDesc" class="small text-info">Bookings (High to Low)</a> |
                    <a href="?dateAsc" class="small text-info">Oldest</a>
                </p>
            </div>
        </div>
        <div class="row">
            @forelse($vehicles as $vehicle)
                <div class="col-md-4">
                    <div class="card">
                        <img class="card-img-top" src="{{url($vehicle->getDriversPicture())}}" alt="Card image cap"
                             height="200px">
                        <div class="card-body">
                            <p class="card-text"><i
                                        class="fa fa-automobile text-info"></i> {{$vehicle->getMakeAndYear()}}</p>
                            <p class="card-text"><i
                                        class="fa fa-line-chart text-info"></i> {{rand(0, 25) . " ".str_plural('time', rand(0, 25))}}
                            </p>
                            <p class="card-text"><i
                                        class="fa fa-money text-info"></i> {{number_format($prices[array_rand($prices)])}}
                            </p>
                            <button class="btn btn-outline-primary btn-block">View</button>
                            <br>
                            {!! Form::open(['url' => "/book-vehicle/$vehicle->id", 'method' => 'POST']) !!}
                            {!! Form::submit('Book', ['class' => 'btn btn-info btn-block']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <br>
                </div>
            @empty
                <h1 class="text-muted">No Vehicles available <i class="fa fa-frown-o"></i></h1>
            @endforelse
        </div>
    </div>
@endsection