$(document).ready(function () {
    $('#btn-login').on('click', function () {
        var username = $("#username").val();
        var password = $("#password").val();
        var loginData = {
            username: username,
            password: password
        };

        if (!username) {
            return displayToast('error', 'Username is required');
        }
        
        if (!password) {
            return displayToast('error', 'Password is required');
        }

        $('#login-form').submit(function(e){
            e.preventDefault();
            $.ajax
                ({
                    type: 'POST',
                    url: '/api/auth',
                    data: loginData,
                    success: function (data, textStatus, xhr) {
                        console.log(xhr.status);
                        if (xhr.status == 200) {
                            console.log(data)
                            displayToastWithRedirect('success', 'Sign in successfully', '/');
                        }
                    },
                    error: function (xhr, textStatus, errorThrown) {
                        console.log(xhr.status);
                        if (xhr.status == 401) {
                            displayToast('error', 'Wrong email or password');
                        }
                    }
                })
            })
        })
    }
)
           
