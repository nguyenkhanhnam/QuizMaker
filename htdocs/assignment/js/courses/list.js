$(document).ready(function () {
    $.ajax({
        type: 'GET',
        url: '/api/courses',
        dataType: 'json',

        complete: function (res) {
            if (res.status !== 200) {
                console.log(res)
            } else {
                var courses = res.responseJSON
                console.log(courses)
                for (var courseIdx = 0; courseIdx < courses.length; courseIdx++) {
                    var row = '<tr>'
                    var col = '<td>' + courses[courseIdx].code + '</td>'
                    col += '<td>' + courses[courseIdx].name + '</td>'
                    row += col
                    row += '</tr>'
                    $('#course-table').append(row)
                }
            }
        }
    }
    );

    $("table > tbody").delegate('tr', 'click', function() {
        window.location.href = '/courses/edit/'+$(this).children('td').html();
    });
});