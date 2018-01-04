@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <h3>Add New Vehicle</h3>
        <hr class="mb-5">
        {!! Form::open(['url' => '/vehicles', 'method'=>'POST', 'files'=>true]) !!}
        @include('vehicles._form')
        {!! Form::close() !!}
    </div>
@endsection