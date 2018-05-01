var codeGlobal = ''
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
                getQuestionWithCode($('#courses').val())
            }
        }
    })

    $('#courses').on('change', function(){
        codeGlobal = $('#courses').val()
        getQuestionWithCode(codeGlobal)
    })
})

function getQuestionDetail(id){
    window.location.href = `/questions/detail/${id}`
}

function removeQuestion(id) {
    $.ajax({
        url: '/api/questions/',
        type: 'DELETE',
        contentType: 'application/json',
        data: {
            id: id
        },
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
                displayToast('success', data.message)
                getQuestionWithCode(codeGlobal)
            }
        }
    })
}

function getQuestions() {
    $.ajax({
        type: 'GET',
        url: '/api/questions',
        dataType: 'json',

        complete: function (res) {
            if (res.status !== 200) {
                console.log(res)
            } else {
                $('#question-table').find("tr:gt(0)").remove();
                var str = res.responseText.trim()
                var questions = JSON.parse(str)
                console.log(questions)
                questions.forEach(question => {
                    var row = '<tr>'
                    var col = '<td onClick=getQuestionDetail(\"' + question.id + '\")>' + question.code + '</td>'
                    col += '<td onClick=getQuestionDetail(\"' + question.id + '\")>' + question.name + '</td>'
                    col += '<td onClick=getQuestionDetail(\"' + question.id + '\")>' + question.question + '</td>'
                    col += '<td onClick=getQuestionDetail(\"' + question.id + '\")>' + getStringDifficult(question.difficult) + '</td>'
                    col += '<td onClick=removeQuestion(\"' + question.id + '\")><i class="material-icons">delete</i>' + '</td>'
                    row += col
                    row += '</tr>'
                    $('#question-table').append(row)
                })
            }
        }
    })
}

function getQuestionWithCode(code) {
    $.ajax({
        type: 'GET',
        url: '/api/questions',
        data: {
            code: code
        },
        dataType: 'json',
        complete: function (res) {
            if (res.status !== 200) {
                console.log(res)
            } else {
                var str = res.responseText.trim()
                var questions = JSON.parse(str)
                console.log(questions)
                $('#question-table').find("tr:gt(0)").remove();
                questions.forEach(question => {
                    var row = '<tr>'
                    var col = '<td onClick=getQuestionDetail(\"' + question.id + '\")>' + question.question + '</td>'
                    col += '<td onClick=getQuestionDetail(\"' + question.id + '\")>' + getStringDifficult(question.difficult) + '</td>'
                    col += '<td onClick=removeQuestion(\"' + question.id + '\")><i class="material-icons">delete</i>' + '</td>'
                    row += col
                    row += '</tr>'
                    $('#question-table').append(row)
                })
            }
        }
    })
}