$(document).ready(function () {
    getUser()
})

var course_global = []

function getUser() {
    $.ajax({
        type: 'GET',
        url: '/api/users',
        dataType: 'json',

        complete: function (res) {
            if (res.status !== 200) {
                console.log(res)
            } else {
                var str = res.responseText.trim()
                var courses = JSON.parse(str)
                course_global = courses
                if (course_global.length > 0) {
                    updateTable()
                    getUser(course_global[0].code)
                }
                else {
                    $('#course-table').find("tr:gt(0)").remove()
                    var row = '<tr>'
                    var col = '<td colspan="2" class="text-center"><em style="color:grey!important">No available course</em></td>'
                    row += col
                    row += '</tr>'
                    $('#course-table').append(row)
                }
            }
        }
    })
}

function updateTable() {
    $('#course-table').find("tr:gt(0)").remove()
    course_global.forEach(course => {
        var row = '<tr>'
        var col = '<td onClick=getCourse(\"' + course.code + '\")>' + course.code + '</td>'
        col += '<td onClick=getCourse(\"' + course.code + '\")>' + course.name + '</td>'
        row += col
        row += '</tr>'
        $('#course-table').append(row)
    })
}