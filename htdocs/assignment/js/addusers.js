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

        console.log(username);
        console.log(password);
        console.log(role_value);

        $.ajax
                ({
                    type: 'POST',
                    url: 'addusers.php',
                    data: userData,
                    success: function (data, textStatus, xhr) {
                        console.log(xhr.status);
                    },
                    error: function (xhr, textStatus, errorThrown) {
                        console.log(xhr.status);
                        alert("Wrong");
                        }
                });
    })
});
