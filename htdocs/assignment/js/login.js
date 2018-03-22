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

        if(!username || !password){
            // Get the snackbar DIV
            var x = document.getElementById("snackbar");
            $("#snackbar").html("Username is required");
            if(!password){
                $("#snackbar").html("Password is required");
            }
           
            $('#snackbar').css("background-color","red");

            // Add the "show" class to DIV
            x.className = "show";

            // After 3 seconds, remove the show class from DIV
            return setTimeout(function () {
                x.className = x.className.replace("show", "");
            }, 3000);
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
                            // Get the snackbar DIV
                            var x = document.getElementById("snackbar");
                            $("#snackbar").html("Sign in successfully");
                            $('#snackbar').css("background-color","black");

                            // Add the "show" class to DIV
                            x.className = "show";

                            // After 3 seconds, remove the show class from DIV
                            setTimeout(function () {
                                x.className = x.className.replace("show", "");
                                window.location.href = "/";
                            }, 3000);
                        }
                    },
                    error: function (xhr, textStatus, errorThrown) {
                        console.log(xhr.status);

                        if (xhr.status == 401) {
                            // Get the snackbar DIV
                            var x = document.getElementById("snackbar");
                            $("#snackbar").html("Wrong email or password");
                            $('#snackbar').css("background-color","red");

                            // Add the "show" class to DIV
                            x.className = "show";

                            // After 3 seconds, remove the show class from DIV
                            setTimeout(function () {
                                x.className = x.className.replace("show", "");
                            }, 3000);
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
