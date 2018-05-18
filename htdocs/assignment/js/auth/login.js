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
                    return displayToastWithRedirect('success', message, '/')
                }
                else {
                    return displayToast('error', message)
                }
            }
        })
    })
}
)

