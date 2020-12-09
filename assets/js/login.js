(function ($) {

    $(document).on('click', '.btn-login', function (e) {
        e.preventDefault();
        var username = $('#username').val();
        var password = $('#password').val();
        if(username != '' && password != '') {
            $.ajax({
                url: "../app/shared/services/authenticate.php",
                method: "POST",
                data: { username: username, password: password},
                dataType: "JSON",
                success: function (data) {
                    if (data.success == true) {
                        localStorage.setItem("auth_token", data.auth_token);
                        window.location.href = '/';
                    } else {
                        window.location.href = 'login.php';
                    }
                }
            });
        } else {
            swal("Error", "Please input required values.", "error");
        }

 
    });
    

})(jQuery);