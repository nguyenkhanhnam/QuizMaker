$(document).ready(function () {
  $('#btn-save').on('click', editCourse)
  $('#btn-delete').on('click', removeCourse)
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
        var str = res.responseText.trim()
        var course = JSON.parse(str)
        $('#code').val(course.code)
        $('#name').val(course.name)
        showButton()
      }
    }
  })
}

function removeCourse() {
  console.log($('#code').val().trim())
  $.ajax({
      url: '/api/courses/',
      type: 'DELETE',
      contentType: 'application/json',
      data: {
          code: $('#code').val().trim()
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

function editCourse(){
  var $form = $('edit-form')
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
}

function showButton(){
  $('#btn-save').show()
  $('#btn-delete').show()
}
