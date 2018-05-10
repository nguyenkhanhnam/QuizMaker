$(document).ready(function () {
  $('#btn-save-account').on('click', function(){editAccount(current_username);})
  $('#btn-delete-account').on('click', function(){removeAccount(current_username);})
})

function getAccount(accountUsername){
  current_username= accountUsername
  $.ajax({
    type: 'GET',
    url: '/api/accounts/' + accountUsername,
    dataType: 'json',
    complete: function (res) {
      if (res.status !== 200) {
        return displayToast('error', 'No account found')
      } else {
        var str = res.responseText.trim()
        var account = JSON.parse(str)
		$('#firstname-detail').val(account.firstname)
		$('#lastname-detail').val(account.lastname)
		$('#middlename-detail').val(account.middlename)
    $('#role-detail').val(account.role)
    var tmp = account.dateofbirth.split('-')
    $('#datePicker-account-detail').val(tmp[2] + '-' + tmp[1] + '-' + tmp[0])
		$('#address-detail').val(account.address)
		$('#phone-detail').val(account.phone)
		$('#email-detail').val(account.email)
        showButtonAccount()
        openSection('editAccount')
      }
    }
  })
}

function removeAccount(_username) {
  $.ajax({
      url: '/api/accounts/',
      type: 'DELETE',
      contentType: 'application/json',
      data: {
          username: _username
      },
      complete: function (res) {
          console.log(res)
          if (res.status !== 200) {
              if (res.status === 500) {
                  var str = res.responseText.trim()
                  var data = JSON.parse(str)
                  displayToast('error', data.message)
              }
          } else {
              var str = res.responseText.trim()
              var data = JSON.parse(str)
              displayToast('success', data.message)
              getAccounts()
          }
      }
  })
}

function editAccount(_username){
  var data = {
    username: _username,
    firstname: $('#firstname-detail').val(),
    lastname: $('#lastname-detail').val(),
    middlename: $('#middlename-detail').val(),
    role: $('#role-detail').val(),
    dateofbirth: $('#datePicker-account-detail').val(),
    address: $('#address-detail').val(),
    email: $('#email-detail').val(),
    phone: $('#phone-detail').val()
  }

    $.ajax({
      url: '/api/accounts/',
      type: 'PUT',
      contentType: 'application/json',
      data: data,
      complete: function (res) {
        if (res.status !== 200) {
          if(res.status === 400){
            displayToast('error', 'Invalid data')
          }
          else if (res.status === 404) {
            displayToast('error', 'Account not found')
          } 
          else if (res.status === 409) {
            displayToast('error', 'Username existed')
          }
        } else {
          displayToast('success', 'Account edited successfully')
          getAccounts()
        }
      }
    })
}

function showButtonAccount(){
	$('#btn-save-account').show()
	$('#btn-delete-account').show()
}
