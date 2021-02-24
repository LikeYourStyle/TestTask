$(document).ready(function () {

    $("#form-signin").submit(function (e) {
        e.preventDefault();

        var login = $.trim($("#login").val());
        var pass = $.trim($("#password").val());

        if (login != '' && pass != '') {
            $(this).unbind().submit();
        }
    });

});