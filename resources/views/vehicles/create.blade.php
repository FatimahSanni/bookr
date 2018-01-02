@extends('layouts.app')
@section('content')
    <div class="container">
        <h3>Add New Vehicle</h3>
        <hr>
        {!! Form::open(['url' => '/vehicles', 'method'=>'POST', 'files'=>true]) !!}
        @include('vehicles._form')
        {!! Form::close() !!}
    </div>
@endsection