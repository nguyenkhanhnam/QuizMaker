$(document).ready(function () {
    getCourses()
})

function getCourseDetail(code){
    window.location.href = `/courses/edit/${code}`
}

function removeCourse(code) {
    console.log(code)
    $.ajax({
        url: '/api/courses/',
        type: 'DELETE',
        contentType: 'application/json',
        data: {
            code: code
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

var course_global = []

function getCourses(){
    $.ajax({
        type: 'GET',
        url: '/api/courses',
        dataType: 'json',

        complete: function (res) {
            if (res.status !== 200) {
                console.log(res)
            } else {
                var str = res.responseText.trim()
                var courses = JSON.parse(str)
                course_global = courses
                updateTable()
            }
        }
    })
}

function updateTable(){
    $('#course-table').find("tr:gt(0)").remove();
    course_global.forEach(course => {
        var row = '<tr>'
        var col = '<td onClick=getCourseDetail(\"' + course.code + '\")>' + course.code + '</td>'
        col += '<td onClick=getCourseDetail(\"' + course.code + '\")>' + course.name + '</td>'
        //col += '<td onClick=removeCourse(\"' + course.code + '\")><i class="material-icons">delete</i>' + '</td>'
        row += col
        row += '</tr>'
        $('#course-table').append(row)
    })
}