$(document).ready(function () {
    var xhttp;
    if (window.XMLHttpRequest) {
        // code for modern browsers
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for old IE browsers
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    $('#btn-login').click(function () {
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

        if (username != '' && password != '') {
            // xhttp.open("POST", "login.php", true);
            // xhttp.setRequestHeader("Authorization: Basic QWxhZGRpbjpvcGVuIHNlc2FtZQ==", "application/x-www-form-urlencoded");
            $.ajax
                ({
                    type: 'POST',
                    url: 'login.php',
                    data: loginData,
                    success: function (data, textStatus, xhr) {
                        console.log(xhr.status);
                        if (xhr.status == 200) {
                            displayToastWithRedirect('success', 'Sign in successfully', '/');
                        }
                    },
                    error: function (xhr, textStatus, errorThrown) {
                        console.log(xhr.status);
                        if (xhr.status == 401) {
                            displayToast('error', 'Wrong email or password');
                        }
                    }
                });
            /* $.ajax({
                type: "POST",
                url: "login.php",
                data: loginData,
                dataType: "json",
                success: function (responseText) {
                    console.log(responseText);
                    if (responseText.status == 'invalid') {
                        $(".error").html("Invalid login.");
                    }
                    else if (responseText.status == 'valid') {
                        $('.after_login').html('Welcome back,' + responseText.username);
                        $('.after_login').show();
                        $('.before_login').hide();
                    }
                    else {
                        alert('Error');
                    }
                }
            });*/
        }
    });
});
