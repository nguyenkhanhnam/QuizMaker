$(document).ready(function () {
    var username= ''
    $('#forgot-password-form').on('submit', function (e) {
        e.preventDefault()
        const forgetPasswordData = getFormData($('#forgot-password-form'))
        // const data = {
        //     username: $('#username').val().trim()
        // }
        if (!forgetPasswordData.username) {
            return displayToast('error', 'username is required')
        }
        username= forgetPasswordData.username
        $.ajax({
            type: 'FORGET',
            url: '/api/auth',
            data: forgetPasswordData,
            complete: function (res) {
                if (res.status === 200){
                    const message = JSON.parse(res.responseText.trim()).message
                    $('#auth-code').removeClass('hide')
                    return displayToast('success', message)
                }
                else {
                    const message = JSON.parse(res.responseText.trim()).message
                    return displayToast('error', message)
                }
            }
        })
    })

    $('#auth-code').on('submit', function(e){
        e.preventDefault()
        const codeData= getFormData($('#auth-code'))
        if(!codeData.verifycode){
            return displayToast('error', 'Please enter verification code')
        }
        const data= {
            username: username,
            vcode: $('#verifycode').val().trim()
        }
        $.ajax({
            type: 'VERIFY',
            url: '/api/auth',
            data: data,
            complete: function(res){
                if(res.status === 200){
                    const message= JSON.parse(res.responseText.trim()).message
                    $('#notification').text("Please check your email for new password.")
                    return displayToast('success', message)
                }
                else{
                    const message= JSON.parse(res.responseText.trim()).message
                    return displayToast('error', message)
                }
            }
        })
    })
})

