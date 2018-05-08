$(document).ready(function () {
  $('#btn-save-course').on('click', editCourse)
  $('#btn-delete-course').on('click', removeCourse)
})

function getCourse(courseCode) {
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
        $('#code-detail').val(course.code)
        $('#name-detail').val(course.name)
        showButtonCourse()
        openSection('editCourse')
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

function editCourse() { // TODO: Khong lay course code tu input nua
  var $form = $('#edit-form-course')
  var data = getFormData($form)
  data.code = $('#code').val().trim()
  $.ajax({
    url: '/api/courses/',
    type: 'PUT',
    contentType: 'application/json',
    data: data,
    complete: function (res) {
      console.log(res)
      if (res.status !== 200) {
        if (res.status === 400) {
          displayToast('error', 'Invalid data')
        }
        else if (res.status === 404) {
          displayToast('error', 'Course not found')
        }
        else if (res.status === 409) {
          displayToast('error', 'Course code existed')
        }
        else {
          displayToast('error', 'khong biet cai gi dang xay ra')
        }
      } else {
        displayToast('success', 'Course edited successfully')
        getCourses()
      }
    }
  })
}

function showButtonCourse() {
  $('#btn-save-course').show()
  $('#btn-delete-course').show()
}
