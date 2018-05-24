var idGlobal = ''

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
                courses.forEach(course => {
                    $('#courses')
                        .append($("<option></option>")
                            .attr("value", course.code)
                            .text(course.name + ' (' + course.code + ')'))
                })
                $('#courses').select2()
                var id = window.location.href.split('/').pop()
                idGlobal = id
                getQuestion(id)
            }
        }
    })

    $('#btn-save').click(function () {
        var questionObj = getFormData($('#edit-form'))
        if (!questionObj.code) {
            return displayToast('error', 'Course code is required')
        }
        if (!questionObj.code.match(/^([A-Z]{2})([0-9]{4})$/)) {
            return displayToast('error', 'Course code is invalid. The format must similar to CO1009')
        }
        if (!questionObj.question) {
            return displayToast('error', 'Question is required')
        }
        if (!questionObj.option1 || !questionObj.option2 || !questionObj.option3 || !questionObj.option4) {
            return displayToast('error', 'Options of question is required')
        }
        if (!questionObj.answer) {
            return displayToast('error', 'Answer of question is required')
        }
        if (!questionObj.difficult) {
            return displayToast('error', 'Difficult of question is required')
        }
        questionObj.id = idGlobal
        $.ajax({
            type: 'PUT',
            url: '/api/questions/',
            data: questionObj,
            complete: function (res) {
                if (res.status !== 200) {
                    if (res.status === 500) {
                        var str = res.responseText.trim()
                        var data = JSON.parse(str)
                        displayToast('error', data.message)
                    }
                } else {
                    var str = res.responseText.trim()
                    var data = JSON.parse(str)
                    getQuestion(idGlobal)
                    return displayToastWithRedirect('success', 'Question saved successfully', '/')
                }
            }
        })
    })
})

function getQuestion(id) {
    $.ajax({
        type: 'GET',
        url: '/api/questions',
        data: {
            id: id
        },
        dataType: 'json',
        complete: function (res) {
            if (res.status !== 200) {
                console.log(res)
            } else {
                var str = res.responseText.trim()
                var question = JSON.parse(str)
                $('#courses').val(question.code).trigger('change')
                $('#question').val(question.question)
                $('#option1').val(question.option1)
                $('#option2').val(question.option2)
                $('#option3').val(question.option3)
                $('#option4').val(question.option4)
                $('#answer').val(question.answer)
                console.log(question.answer)
                $("input[value='" + question.difficult + "']").prop('checked', true)
            }
        }
    })
}
