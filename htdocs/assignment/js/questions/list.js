$(document).ready(function () {
    getQuestions()
})

function getQuestionDetail(id){
    window.location.href = `/questions/${id}`
}

function removeQuestion(id) {
    $.ajax({
        url: '/api/questions/',
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
                getQuestions()
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