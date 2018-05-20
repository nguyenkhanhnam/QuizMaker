$(document).ready(function () {
    $('#btn-save-profile').on('click', function () { saveProfile() })
    $('#datePicker-profile').datepicker({
      format: 'dd/mm/yyyy'
    })

    $.ajax({
        type: 'GET',
        url: '/api/profile/',
        dataType: 'json',
        complete: function (res) {
          if (res.status !== 200) {
            return displayToast('error', 'No profile found')
          } else {
            var str = res.responseText.trim()
            var profile = JSON.parse(str)
            $('#firstname-profile').val(profile.firstname)
            $('#lastname-profile').val(profile.lastname)
            $('#middlename-profile').val(profile.middlename)
            $('#role-profile').val(profile.role)
            var tmp = profile.dateofbirth.split('-')
            $('#datePicker-profile').val(tmp[2] + '/' + tmp[1] + '/' + tmp[0])
            $('#address-profile').val(profile.address)
            $('#phone-profile').val(profile.phone)
            $('#email-profile').val(profile.email)
          }
        }
    })
})

function saveProfile() {
    var data = {
      firstname: $('#firstname-profile').val(),
      lastname: $('#lastname-profile').val(),
      middlename: $('#middlename-profile').val(),
      dateofbirth: $('#datePicker-profile').val(),
      address: $('#address-profile').val(),
      email: $('#email-profile').val(),
      phone: $('#phone-profile').val()
    }
  
    $.ajax({
      url: '/api/profile/',
      type: 'POST',
      contentType: 'application/json',
      data: data,
      complete: function (res) {
        console.log(res)
        if (res.status !== 200) {
          const message = JSON.parse(res.responseText.trim()).message
          displayToast('error', message)
        } else {
          const message = JSON.parse(res.responseText.trim()).message
          displayToast('success', message)
        }
      }
    })
  }