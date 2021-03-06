$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#account_form').submit(function (e) {
        e.preventDefault();
        e.stopPropagation();
        var form = $(this);
        $.ajax({
            url: '/account',
            type: 'POST',
            data: form.serialize(),
            success: function (data) {
                console.log(data);
                $('#password_msg').addClass('allgood').removeClass('notallgood').text('Your password has been changed!').show().delay(2000).fadeOut(1000);
                document.getElementById('account_form').reset();
            },
            error: function (data) {
                console.log(data);
                $('#password_msg').addClass('notallgood').removeClass('allgood').text('Your current password is wrong, your new password is too short or passwords do not match.').show().delay(2000).fadeOut(1000);
            }
        });
    });
});