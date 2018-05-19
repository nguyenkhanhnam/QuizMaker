$(document).ready(function () {
    $('form').on('submit', function (e) {
        e.preventDefault()
        const loginData = getFormData($('form'))
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
                const message = JSON.parse(res.responseText.trim()).message
                if (res.status === 200){
                    window.location.reload()
                }
                else {
                    $('#login-modal').removeClass('fadeIn')
                    $('#login-modal').addClass('shake')
                    $('input[type=password]').val('')
                    setTimeout(function(){
                        $('#login-modal').removeClass('shake')
                    }, 1000)
                }
            }
        })
    })
})

