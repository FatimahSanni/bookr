/**
 * Created by TheFatimah on 04/01/2018.
 */
$(document).ready(function () {
    let amount = Math.floor(Math.random() * 47) * 500 + 500;
    // Open Booking form for vehicle
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
    // Book Vehicle
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
            $('#bookVehicleModal' + vehicleId).modal('hide');
            self.removeAttr('disabled');
            window.location.replace("/vehicles/" + vehicleId);
            swal("<i class='fa fa-thumbs-up'></i>", data, "success");
        }).always(function () {
            self.removeAttr('disabled');
        }).fail(function (xhr) {
            processAjaxError(xhr.responseText)
        });
    });
    // Process notification error
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

    //  Submit incidence report
    $('.report-vehicle').on('click', function (e) {
        let self = $(this);
        e.preventDefault();
        $.ajax({
            url: '/report-vehicle',
            type: 'POST',
            data: {
                license_number: $('#license_number').val(),
                collision: $('#collision').val(),
                injury: $('#injury').val(),
                location: $('#location').val(),
                comment: $('#comment').val(),
                _token: $("[name=_token]").val()
            },
            beforeSend: function () {
                self.attr('disabled', 'disabled');
            }
        }).done(function (data) {
            self.removeAttr('disabled');
            swal("<i class='fa fa-thumbs-up'></i>", data, "success");
            $("input", "#reportVehicleModal").val('');
            $("textarea", "#reportVehicleModal").val('');
            $('#reportVehicleModal').modal('hide');
        }).fail(function (xhr) {
            processAjaxError(xhr.responseText);
        }).always(function () {
            self.removeAttr('disabled');
        });
    });
});