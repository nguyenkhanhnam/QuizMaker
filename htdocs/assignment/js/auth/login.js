$(document).ready(function () {
    $('#login-form').on('submit', function (e) {
        e.preventDefault()
        const loginData = getFormData($('#login-form'))
        if (!loginData.username) {
            return displayToast('error', 'Username is required')
        }

        if (!loginData.password) {
            return displayToast('error', 'Password is required')
        }

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
})