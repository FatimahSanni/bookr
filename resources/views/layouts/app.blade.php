<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'VehicleBookr') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div>
    @include('layouts._navigation')
    @yield('content')
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/sweetalert2@7.3.2/dist/sweetalert2.all.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        let amount = Math.floor(Math.random() * 47) * 500 + 500;
        $('.book-vehicle').on('click', function (e) {
            if (!$('#search-pickup').val() && !$('#search-destination').val() && !$('#search-from-date').val() && !$('#search-to-date').val()) {
                e.stopPropagation();
                swal('', 'Enter pickup, destination and dates', 'error');
            } else {
                e.preventDefault();
                $('#pickup').val($('#search-pickup').val());
                $('#destination').val($('#search-destination').val());
                $('#from-date').val($('#search-from-date').val());
                $('#to-date').val($('#search-from-date').val());
                $('.vehicle-fare').val(amount);
            }
        });
        $('.submit-booking-details').on('click', function (e) {
            let self = $(this);
            let vehicleId = $(this).data('vehicle-id');
            e.preventDefault();
            $.ajax({
                url: "/book-vehicle/" + vehicleId,
                type: 'POST',
                data: {
                    _token: $("[name=_token]").val(),
                    pickup: $('#pickup').val(),
                    destination: $('#destination').val(),
                    from_date: $('#from_date').val(),
                    to_date: $('#to_date').val(),
                    amount: $('.vehicle-fare', "#bookVehicleModal" + vehicleId).val(),
                    card_name: $(".card-name", "#bookVehicleModal" + vehicleId).val(),
                    card_number: $(".card-number", "#bookVehicleModal" + vehicleId).val(),
                    cvv: $(".cvv", "#bookVehicleModal" + vehicleId).val(),
                    expiry_month: $(".expiry_month", "#bookVehicleModal" + vehicleId).val(),
                    expiry_year: $(".expiry_year", "#bookVehicleModal" + vehicleId).val(),
                },
                beforeSend: function () {
                    self.attr('disabled', 'disabled');
                }
            }).done(function (data) {
                swal("<i class='fa fa-thumbs-up'></i>", data, "success");
                $('#bookVehicleModal' + vehicleId).modal('hide');
                self.removeAttr('disabled');
                window.location.replace("/vehicles");
            }).always(function () {
                self.removeAttr('disabled');
            }).fail(function (xhr) {
                processAjaxError(xhr.responseText)
            });
        });
        function processAjaxError(text) {
            var errors = JSON.parse(text);
            var errorHtml = '<div class="text-center">';

            if (errors.hasOwnProperty('message')) {
                errorHtml += '<strong>' + errors['message'] + '</strong> <br><br>';
            }
            if (errors.hasOwnProperty('errors')) {
                for (key in errors['errors']) {
                    errorHtml += errors['errors'][key] + "<br><br>";
                }
            }
            swal('<i class="fa fa-frown-o"></i>', errorHtml, 'error')
        }
    });
</script>
</body>
</html>
