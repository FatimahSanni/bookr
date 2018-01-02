@extends('layouts.app')
@section('content')
    <div class="container">
        <h3>Edit Vehicle's Details</h3>
        <hr>
        {!! Form::model($vehicle, ['url' => '/vehicles', 'method'=>'POST', 'files'=>true]) !!}
        @include('vehicles._form')
        {!! Form::close() !!}
    </div>
@endsection