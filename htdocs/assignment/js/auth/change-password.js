$(document).ready(function () {
    $('#change-password-form').on('submit', function (e) {
        e.preventDefault()
        const changePasswordData = getFormData($('#change-password-form'))
        if (!changePasswordData.currentPassword) {
            return displayToast('error', 'Current password is required')
        }
        if (!changePasswordData.password) {
            return displayToast('error', 'Password is required')
        }
        if (!changePasswordData.confirmPassword) {
            return displayToast('error', 'Confirm Password is required')
        }
        if (changePasswordData.confirmPassword !== changePasswordData.password) {
            return displayToast('error', 'Confirm Password doesn\'t match new password')
        }

        delete changePasswordData.confirmPassword

        $.ajax({
            type: 'POST',
            url: '/api/auth',
            data: changePasswordData,
            complete: function (res) {
                const message = JSON.parse(res.responseText.trim()).message
                if (res.status === 200){
                    window.location.href = '/'
                }
                else {
                    // $('#login-modal').removeClass('fadeIn')
                    // $('#login-modal').addClass('shake')
                    // $('input[type=password]').val('')
                    // setTimeout(function(){
                    //     $('#login-modal').removeClass('shake')
                    // }, 1000)
                }
            }
        })
    })
})

