$(document).ready(function () {
    $('#btn-login').on('click', function () {
        var username = $("#username").val()
        var password = $("#password").val()
        var loginData = {
            username: username,
            password: password
        }

        if (!username) {
            return displayToast('error', 'Username is required')
        }

        if (!password) {
            return displayToast('error', 'Password is required')
        }

        $('#login-form').submit(function (e) {
            e.preventDefault()
            $.ajax({
                type: 'POST',
                url: '/api/auth',
                data: loginData,
                complete: function (res) {
                    const message = JSON.parse(res.responseText.trim()).message
                    if (res.status === 200){
                        return displayToastWithRedirect('success', message, '/')
                    }
                    else {
                        return displayToast('error', message)
                    }
                }
            })
        })
    })
}
)

