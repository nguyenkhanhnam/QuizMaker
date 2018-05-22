$(document).ready(function () {
    $('#login-form').on('submit', function (e) {
        e.preventDefault()
        const loginData = getFormData($('#login-form'))
        if (!loginData.username) {
            $('#login-modal #error').text('Username is required')
            return
        }

        if (!loginData.password) {
            $('#login-modal #error').text('Password is required')
            return
        }

        loginData.username = loginData.username.toLowerCase()

        $.ajax({
            type: 'POST',
            url: '/api/auth',
            data: loginData,
            complete: function (res) {
                if (res.status === 200) {
                    window.location.href = '/'
                }
                else {
                    const message = JSON.parse(res.responseText.trim()).message
                    $('#login-modal #error').text(message)
                    $('#login-modal').removeClass('fadeIn')
                    $('#login-modal').addClass('shake')
                    $('input[type=password]').val('')
                    setTimeout(function () {
                        $('#login-modal').removeClass('shake')
                    }, 1000)
                }
            }
        })
    })

    $('#login-modal').on('shown.bs.modal', function () {
        $('#login-modal #error').text('')
    })
})