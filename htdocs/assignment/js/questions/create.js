$(document).ready(function () {
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
                console.log(courses)
                courses.forEach(course => {
                    $('#courses')
                        .append($("<option></option>")
                            .attr("value", course.code)
                            .text(course.name + ' (' + course.code + ')'))
                })
                $('#courses').select2();
                // for (var courseIdx = 0; courseIdx < courses.length; courseIdx++) {
                //     var row = '<tr>'
                //     var col = '<td>' + courses[courseIdx].code + '</td>'
                //     col += '<td>' + courses[courseIdx].name + '</td>'
                //     row += col
                //     row += '</tr>'
                //     $('#course-table').append(row)
                // }
            }
        }
    }
    );
    $('#btn-add').click(function () {
        var questionObj = getFormData($('#create-form'))

        // if (!courseCode) {
        //     return displayToast('error', 'Course code is required');
        // }

        // if (courseCode.length != 6) {
        //     return displayToast('error', 'Course code is invalid. The length must equal 6.');
        // }

        // if (!courseCode.match(/^([A-Z]{2})([0-9]{4})$/)) {
        //     return displayToast('error', 'Course code is invalid. The format must similar to CO1009');
        // }

        // if (!courseName || courseName.trim().length == 0) {
        //     return displayToast('error', 'Course name is required');
        // }

        // if (courseName.length > 50) {
        //     return displayToast('error', 'Course name is invalid. The length can not exceed 50.');
        // }

        $.ajax
            ({
                type: 'POST',
                url: '/api/questions/',
                data: questionObj,
                success: function (data, textStatus, xhr) {
                    console.log(xhr.status);
                    console.log(data);
                    if (xhr.status == 200) {
                        return displayToastWithRedirect('success', 'Question added successfully', '/questions');
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    return displayToast('error', '');
                }
            }
            )
    });
});
