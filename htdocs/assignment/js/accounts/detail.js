$(document).ready(function () {
  $('#btn-save-account').on('click', editAccount)
  $('#btn-delete-account').on('click', removeAccount)
})

function getAccount(accountUsername){
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
		$('#datePicker-account-detail').val(account.dateofbirth)
		$('#address-detail').val(account.address)
		$('#phone-detail').val(account.phone)
		$('#email-detail').val(account.email)
        showButtonAccount()
        openSection('editAccount')
      }
    }
  })
}

function removeAccount() {
  $.ajax({
      url: '/api/accounts/',
      type: 'DELETE',
      contentType: 'application/json',
      data: {
          code: $('#code-detail').val().trim()
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
              getCourses()
          }
      }
  })
}

function editAccount(){
  var $form = $('edit-form')
  var data = {
    code: $('#code-detail').val(),
    name: $('#name-detail').val()
  }
  $('#edit-form').submit(function () {
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
            displayToast('error', 'Course not found')
          } 
          else if (res.status === 409) {
            displayToast('error', 'Course code existed')
          }
        } else {
          displayToast('success', 'Course edited successfully')
          getCourses()
        }
      }
    })
    return false
  })
}

function showButtonAccount(){
	$('#btn-save-account').show()
	$('#btn-delete-account').show()
}
