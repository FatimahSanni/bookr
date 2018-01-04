<div class="modal fade" id="bookVehicleModal{{$vehicle->id}}" tabindex="-1" role="dialog"
     aria-labelledby="bookVehicleModalLabel"
     aria-hidden="true" v-if="showModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Book {{$vehicle->getMakeAndYear()}}
                    ({{$vehicle->license_number}})</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! csrf_field() !!}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('from_date') !!}
                            {!! Form::date('from_date', null, ['class'=>'form-control', 'disabled']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('to_date') !!}
                            {!! Form::date('to_date', null, ['class'=>'form-control', 'disabled']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('pickup') !!}
                            {!! Form::select('pickup', $routes, null, ['class'=>'form-control', 'placeholder'=>'Pickup', 'disabled']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('destination') !!}
                            {!! Form::select('destination', $routes, null, ['class'=>'form-control', 'placeholder'=>'Destination', 'disabled']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('amount') !!}
                    {!! Form::number('amount', null, ['class'=>'form-control vehicle-fare', 'readonly']) !!}
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            {!! Form::label('card-number') !!}
                            {!! Form::number('card-number', null, ['class'=>'form-control card-number', 'required']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        {!! Form::label('cvv', 'CVV') !!}
                        {!! Form::number('cvv', null, ['class'=>'form-control cvv', 'required']) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            {!! Form::label('card-name', 'Name on card') !!}
                            {!! Form::text('card-name', null, ['class'=>'form-control card-name', 'required']) !!}
                        </div>
                    </div>
                    <div class="col-md-2">
                        {!! Form::label('expiry_month', 'Month') !!}
                        {!! Form::select('expiry_month', $months, null, ['class'=>'form-control expiry_month', 'placeholder'=>'mm']) !!}

                    </div>
                    <div class="col-md-2">
                        {!! Form::label('expiry_year', 'Year') !!}
                        {!! Form::select('expiry_year', $expiryYearsForCreditCards, null, ['class'=>'form-control expiry_year', 'placeholder'=>'yyyy']) !!}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success submit-booking-details" data-vehicle-id="{{$vehicle->id}}">
                    Submit
                </button>
            </div>
        </div>
    </div>
</div>