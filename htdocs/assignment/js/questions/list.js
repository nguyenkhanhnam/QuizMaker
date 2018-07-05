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

    $('#courses').on('change', function () {
        codeGlobal = $('#courses').val()
        getQuestionWithCode(codeGlobal)
    })

    initDataTable()

    // $('#question-table tbody').on('click', 'tr', function () {
    //     var data = dataTable.row(this).data()
    //     alert( 'You clicked on '+data[0]+'\'s row' )
    // })
})

var dataTable

function initDataTable() {
    dataTable = $('#question-table').DataTable({
        aLengthMenu: [
            [10, 20, 50, -1],
            [10, 20, 50, 'All']
        ],
        iDisplayLength: 20,
        language: {
            decimal: '.',
            thousands: ',',
            url: '//cdn.datatables.net/plug-ins/1.10.15/i18n/English.json'
        },
        search: {
            caseInsensitive: true
        },
        'columnDefs': [{
            'targets': [3],
            sortable: false
        }],
        aaSorting: [],
        order: [1, 'asc']
    })
}

function getQuestionDetail(id) {
    window.location.href = `/questions/detail/${id}`
}

function removeQuestion(id) {
    var r = confirm('Are you sure you want to delete this question?');
    if (r == true) {
    } else {
      return
    }
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

// function getQuestions() {
//     $.ajax({
//         type: 'GET',
//         url: '/api/questions',
//         dataType: 'json',

//         complete: function (res) {
//             if (res.status !== 200) {
//                 console.log(res)
//             } else {
//                 $('#question-table').find("tr:gt(0)").remove()
//                 var str = res.responseText.trim()
//                 var questions = JSON.parse(str)
//                 questions.forEach(question => {
//                     var row = '<tr>'
//                     var col = '<td onClick=getQuestionDetail(\"' + question.id + '\")>' + question.code + '</td>'
//                     col += '<td onClick=getQuestionDetail(\"' + question.id + '\")>' + question.name + '</td>'
//                     col += '<td onClick=getQuestionDetail(\"' + question.id + '\")>' + question.question + '</td>'
//                     col += '<td onClick=getQuestionDetail(\"' + question.id + '\")>' + getStringDifficult(question.difficult) + '</td>'
//                     col += '<td onClick=removeQuestion(\"' + question.id + '\")><i class="material-icons">delete</i>' + '</td>'
//                     row += col
//                     row += '</tr>'
//                     $('#question-table').append(row)
//                 })
//                 // initDataTable()
//             }
//         }
//     })
// }

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
                dataTable.clear().draw();
                questions.forEach(question => {
                    dataTable.rows.add([['<span onclick="getQuestionDetail(' + question.id + ')">' + question.code + '</span>'
                                        , '<span onclick="getQuestionDetail(' + question.id + ')">' + question.question + '</span>'
                                        , '<span onclick="getQuestionDetail(' + question.id + ')">' + getStringDifficult(question.difficult) + '</span>'
                                        , '<i onclick="removeQuestion(' + question.id + ')" class="material-icons">delete</i>']])
                })
                dataTable.columns.adjust().draw(); // Redraw the DataTable
            }
        }
    })
}