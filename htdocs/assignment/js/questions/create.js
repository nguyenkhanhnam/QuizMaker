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
            }
        }
    }
    );
    $('#btn-add').click(function () {
        var questionObj = getFormData($('#create-form'))
        if (!questionObj.code) {
            return displayToast('error', 'Course code is required');
        }
        if (!questionObj.code.match(/^([A-Z]{2})([0-9]{4})$/)) {
            return displayToast('error', 'Course code is invalid. The format must similar to CO1009');
        }
        if (!questionObj.question) {
            return displayToast('error', 'Question is required');
        }
        if (!questionObj.option1 || !questionObj.option2 || !questionObj.option3 || !questionObj.option4) {
            return displayToast('error', 'Options of question is required');
        }
        if (!questionObj.answer) {
            return displayToast('error', 'Answer of question is required');
        }
        if (!questionObj.difficult) {
            return displayToast('error', 'Difficult of question is required');
        }
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
