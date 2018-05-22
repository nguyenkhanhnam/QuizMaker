$(document).ready(function () {
    var username = ''
    $('#forgot-password-form').on('submit', function (e) {
        e.preventDefault()
        const forgetPasswordData = getFormData($('#forgot-password-form'))
        if (!forgetPasswordData.username) {
            $('#forgot-password-modal #error').text('Username is required')
            return
        }
        $('#forgot-password-form button').prop('disabled', true)
        username = forgetPasswordData.username
        $.ajax({
            type: 'FORGET',
            url: '/api/auth',
            data: forgetPasswordData,
            complete: function (res) {
                if (res.status === 200) {
                    const message = JSON.parse(res.responseText.trim()).message
                    $('#auth-code').removeClass('hide')
                    $('#forgot-password-modal #error').text('')
                    $('#forgot-password-modal #success').text(message)
                    $('#forgot-password-form button').hide()
                    $('#forgot-password-form #username').prop('readonly', true);
                }
                else {
                    const message = JSON.parse(res.responseText.trim()).message
                    $('#forgot-password-modal #error').text(message)
                    $('#forgot-password-form button').prop('disabled', false)
                }
            }
        })
    })

    $('#auth-code').on('submit', function (e) {
        e.preventDefault()
        const codeData = getFormData($('#auth-code'))
        if (!codeData.verifycode) {
            return displayToast('error', 'Please enter verification code')
        }
        const data = {
            username: username,
            vcode: $('#verifycode').val().trim()
        }
        $('#auth-code button').prop('disabled', true)
        $.ajax({
            type: 'VERIFY',
            url: '/api/auth',
            data: data,
            complete: function (res) {
                if (res.status === 200) {
                    $('#forgot-password-modal').modal('hide')
                    const message = JSON.parse(res.responseText.trim()).message
                    return displayToast('success', message)
                }
                else {
                    const message = JSON.parse(res.responseText.trim()).message
                    $('#forgot-password-modal #error').text(message)
                    $('#auth-code button').prop('disabled', false)
                }
            }
        })
    })
})

