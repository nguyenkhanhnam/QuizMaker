$(document).ready(function () {
  var path = window.location.href.split('/')
  var courseCode = path.pop() || path.pop()

  $.ajax({
    type: 'GET',
    url: '/api/courses/' + courseCode,
    dataType: 'json',
    complete: function (res) {
      if (res.status !== 200) {
        return displayToastWithRedirect('error', 'No course found', '/courses')
      } else {
        console.log(res.responseText)
        var str = res.responseText.trim()
        var course = JSON.parse(str)
        $('#code').val(course.code)
        $('#name').val(course.name)
      }
    }
  }
  )

  $('#btn-save').on('click', function () {
    var $form = $('form')
    //var data = getFormData($form)
    var data = {
      code: $('#code').val(),
      name: $('#name').val()
    }
    $('form').submit(function () {
      $.ajax({
        url: '/api/courses/',
        type: 'PUT',
        contentType: 'application/json',
        data: data,
        complete: function (res) {
          if (res.status !== 200) {
            if(res.status === 400){
              displayToast('error', 'Invalid data')
            }
            else if (res.status === 404) {
              displayToastWithRedirect('error', 'Course not found', '/courses')
            } 
            else if (res.status === 409) {
              displayToast('error', 'Course code existed')
            }
          } else {
            displayToastWithRedirect('success', 'Course edited successfully', '/courses')
          }
        }
      })
      return false
    })
  })
})