$(document).ready(function () {
    var typingTimer;
    var doneTypingInterval = 5000;


    $('#confirm_password').keyup(function () {
        clearTimeout(typingTimer);
        typingTimer =setTimeout(doneTyping, doneTypingInterval);
    });

    $('#confirm_password').keydown(function () {
        clearTimeout(typingTimer);
    })
});

function doneTyping() {
    var route = "http://localhost/registration";
    var form_request = $('#request-form');
    $('.warning').remove();
    $('.form-content input').css('border', '1px solid #c3c3c3');

   $.ajax({
        type: 'POST',
        url: route,
        data: form_request.serialize(),
        success: function(response) {
            console.log(response)

            if(response.success){
                $('.form-content input').css('border', '1px solid green');
                $('.form-content label').css('color', 'green');

                $('#submit-button').click(function () {
                    form_request.submit();
                })

            }
            if (response.errors){
                $('#submit-button').click(function (e) {
                    e.preventDefault();
                })
                if(response.errors.firstname) {
                    $('#firstname').css('border', '1px solid red');
                    $('#error_first_name').append(`<span class="warning">${response.errors.firstname}</span>`);
                }

                if (response.errors.lastname) {
                    $('#lastname').css('border', '1px solid red');
                    $('#error_last_name').append(`<span class="warning">${response.errors.lastname}</span>`);
                }

                if (response.errors.email) {
                    $('#email').css('border', '1px solid red');
                    $('#error_email').append(`<span class="warning">${response.errors.email}</span>`);
                }

                if (response.errors.password) {
                    $('#password').css('border', '1px solid red');
                    $('#error_password').append(`<span class="warning">${response.errors.password}</span>`);
                }

                if (response.errors.confirm_password){
                    $('#confirm_password').css('border', '1px solid red');
                    $('#error_confirm_password').append(`<span class="warning">${response.errors.confirm_password}</span>`)
                }

                if (response.errors.checkbox){
                    $('#error_checkbox').append(`<span class="warning">${response.errors.checkbox}</span>`);
                }
            }
        }

    });
}
