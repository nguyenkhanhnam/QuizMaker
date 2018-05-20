$(document).ready(function () {
    $('#btn-add-account').click(function () {
        var accountData = {
            firstname: $('#firstname-create').val(),
            lastname: $('#lastname-create').val(),
            middlename: $('#middlename-create').val(),
            role: $('#role-create').val(),
            dateofbirth: $('#datePicker-account-create').val(),
            address: $('#address-create').val(),
            email: $('#email-create').val(),
            phone: $('#phone-create').val()
        }

        $.ajax
            ({
                type: 'POST',
                url: '/api/accounts/',
                data: accountData,
                success: function (data, textStatus, xhr) {
                    console.log(xhr.status)
                    if (xhr.status == 200) {
                        getAccounts()
                        return displayToast('success', 'Account added successfully')
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.log(xhr.status)
                    if (xhr.status == 409) {
                        return displayToast('error', 'Something wrong!') 
                    }
                    else if (xhr.status == 400) {
                        return displayToast('error', 'Invalid input!') 
                    }
                }
            })
    })
})
