/**
 * Created by TheFatimah on 04/01/2018.
 */
function processAjaxError(text) {
    //get the error from the ajax object
    try {
        var errors = JSON.parse(text);

        var errorHtml = '<div class="text-center">';

        if (errors.hasOwnProperty('message')) {
            errorHtml += errors['message'] + '<br>';
            if (errors.hasOwnProperty(key)) {
                errorHtml += errors[key][0] + '<br>';
            }
        }

        //generate appropriate html for the error
        errorHtml += '</div>';

        //display a sticky notification for this error
        swal('Error', errorHtml, "error");

        if (errors.hasOwnProperty('redirect_url') && errors['redirect_url'] !== null) {
            window.setTimeout(function () {
                window.location = errors['redirect_url'];
            }, 3000);
        }
    } catch (e) {
        //malformed response
    }
}