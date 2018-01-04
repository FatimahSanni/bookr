<div class="modal fade" id="reportVehicleModal" tabindex="-1" role="dialog" aria-labelledby="reportVehicleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reportVehicleModalLabel">Report Vehicle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! csrf_field() !!}
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            {!! Form::label('license_number', 'License/Plate Number') !!}
                            {!! Form::text('license_number', null, ['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            {!! Form::label('collision') !!}
                            {!! Form::checkbox('collision', null,false, ['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            {!! Form::label('injury') !!}
                            {!! Form::checkbox('injury', null,false, ['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('location') !!}
                    {!! Form::text('location', null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('comment', 'Comment/Observation') !!}
                    {!! Form::textarea('comment', null, ['class'=>'form-control']) !!}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-info report-vehicle" data-dismiss="modal">Submit</button>
            </div>
        </div>
    </div>
</div>