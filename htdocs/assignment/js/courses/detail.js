$(document).ready(function () {
  var path = window.location.href.split('/')
  var courseCode = path.pop() || path.pop()

  $('#btn-save').on('click', function () {
    var $form = $('form')
    //var data = getFormData($form)
    var data = {
      code: $('#code').val(),
      name: $('#name').val()
    }
    $('#edit-form').submit(function () {
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
  })
})

function getCourse(courseCode){
  $.ajax({
    type: 'GET',
    url: '/api/courses/' + courseCode,
    dataType: 'json',
    complete: function (res) {
      if (res.status !== 200) {
        return displayToast('error', 'No course found')
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
}