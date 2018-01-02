<div class="row">
    <div class="col-6">
        <div class="form-group">
            {!! Form::label('vehicle_type', 'Type of Vehicle') !!}
            {!! Form::select('vehicle_model_id', $vehicleModels, null, ['class'=>'form-control']) !!}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {!! Form::label('year_of_manufacture') !!}
            {!! Form::select('year_of_manufacture', $years, null, ['class'=>'form-control']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-6">
        <div class="form-group">
            {!! Form::label('license_number') !!}
            {!! Form::text('license_number', null, ['class'=>'form-control']) !!}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {!! Form::label('chassis_number') !!}
            {!! Form::text('chassis_number',null, ['class'=>'form-control']) !!}
        </div>
    </div>
</div>
<hr>
<div class="form-group">
    {!! Form::label('picture', "Upload Driver's Photo") !!}
    {!! Form::file('picture', ['class'=>'form-control']) !!}
</div>
<div class="row">
    <div class="col-6">
        <div class="form-group">
            {!! Form::label('first_name') !!}
            {!! Form::text('first_name', null, ['class'=>'form-control']) !!}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {!! Form::label('last_name') !!}
            {!! Form::text('last_name', null, ['class'=>'form-control']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-6">
        <div class="form-group">
            {!! Form::label('username') !!}
            {!! Form::text('username', null, ['class'=>'form-control']) !!}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {!! Form::label('email') !!}
            {!! Form::email('email', null, ['class'=>'form-control']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-6">
        <div class="form-group">
            {!! Form::label('date_of_birth') !!}
            {!! Form::date('date_of_birth', null, ['class'=>'form-control']) !!}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {!! Form::label('drivers_license', "Upload Driver's License") !!}
            {!! Form::file('drivers_license', ['class'=>'form-control']) !!}
        </div>
    </div>
</div>
<div class="form-group">
    {!! Form::submit('Add New Vehicle', ['class'=>'btn btn-info btn-block']) !!}
</div>