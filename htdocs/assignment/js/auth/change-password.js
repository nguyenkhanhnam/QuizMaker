$(document).ready(function () {
    $('#change-password-form').on('submit', function (e) {
        e.preventDefault()
        const changePasswordData = getFormData($('#change-password-form'))
        if (!changePasswordData.currentPassword) {
            $('#change-password-modal #error').text('Current password is required')
            return
        }
        if (!changePasswordData.password) {
            $('#change-password-modal #error').text('Password is required')
            return
        }
        if (!changePasswordData.confirmPassword) {
            $('#change-password-modal #error').text('Confirm password is required')
            return
        }
        if (changePasswordData.confirmPassword !== changePasswordData.password) {
            $('#change-password-modal #error').text('Confirm password doesn\'t match new password')
            $('#password').val('')
            $('#confirm-password').val('')
            return
        }

        delete changePasswordData.confirmPassword

        $.ajax({
            type: 'CHANGE',
            url: '/api/auth',
            data: changePasswordData,
            complete: function (res) {
                if (res.status === 200){
                    $('#change-password-modal').modal('hide')
                    $('#change-password-modal #error').text('')
                    const message = JSON.parse(res.responseText.trim()).message
                    return displayToast('success', message)
                }
                else {
                    const message = JSON.parse(res.responseText.trim()).message
                    $('#change-password-modal #error').text(message)
                    $('input[type=password]').val('')
                }
            }
        })
    })

    $('#change-password-modal').on('shown.bs.modal', function () {
        $('#change-password-modal #error').text('')
        $('#change-password-modal input[type=password]').val('')
    })
})

