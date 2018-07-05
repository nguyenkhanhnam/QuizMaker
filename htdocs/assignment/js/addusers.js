$(document).ready(function () {
    var xhttp;
    if (window.XMLHttpRequest) {
        // code for modern browsers
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for old IE browsers
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    $("#btn-adduser").click(function () {

        var username = $("#inputUsername").val();
        var password = $("#inputPassword").val();
        var role_value = $('input[name=inlineRadioOptions]:checked', '#myform').val();   

        var userData = {
            username: username,
            password: password,
            role_value: role_value 
        };

        if (!username.length || !password.length) {
            // Get the snackbar DIV
            var x = document.getElementById("snackbar");
            $("#snackbar").html("Username or password is empty");
            $('#snackbar').css("background-color","red");

            // Add the "show" class to DIV
            x.className = "show";

             // After 3 seconds, remove the show class from DIV
            setTimeout(function () {
                x.className = x.className.replace("show", "");
            }, 3000);

            return 0;
        }


        $.ajax
                ({
                    type: 'POST',
                    url: 'addusers.php',
                    data: userData,
                    success: function (data, textStatus, xhr) {
                        console.log(xhr.status);
                        if (xhr.status == 200) {
                            // Get the snackbar DIV
                            var x = document.getElementById("snackbar");
                            $("#snackbar").html("Create account successfully")
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
                        if (xhr.status == 409) {
                            // Get the snackbar DIV
                            var x = document.getElementById("snackbar");
                            $("#snackbar").html("Username already exists");
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
    })
});
