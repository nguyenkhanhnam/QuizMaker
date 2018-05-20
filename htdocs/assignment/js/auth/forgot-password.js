$(document).ready(function () {
    $('#forgot-password-form').on('submit', function (e) {
        e.preventDefault()
        const data = {
            email: $('#email').val().trim()
        }
        $.ajax({
            type: 'POST',
            url: '/api/auth',
            data: data,
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

