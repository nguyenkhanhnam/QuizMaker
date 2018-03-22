$(document).ready(function () {
    $('#btn-add').click(function () {
        var courseCode = $("#code").val();
        var courseName = $("#name").val();
        var courseData = {
            code: courseCode,
            name: courseName
        };

        if (!courseCode) {
            return displayToast('error', 'Course code is required');
        }

        if (courseCode.length != 6) {
            return displayToast('error', 'Course code is invalid. The length must equal 6.');
        }

        if (!courseCode.match(/^([A-Z]{2})([0-9]{4})$/)) {
            return displayToast('error', 'Course code is invalid. The format must similar to CO1009');
        }

        if (!courseName || courseName.trim().length == 0) {
            return displayToast('error', 'Course name is required');
        }

        if (courseName.length > 50) {
            return displayToast('error', 'Course name is invalid. The length can not exceed 50.');
        }

        $.ajax
            ({
                type: 'POST',
                url: 'course.php',
                data: courseData,
                success: function (data, textStatus, xhr) {
                    console.log(xhr.status);
                    console.log(data);
                    if (xhr.status == 200) {
                        return displayToast('success', 'Course added successfully');
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.log(xhr.status);

                    if (xhr.status == 409) {
                        return displayToast('error', 'Course code existed!');
                    }
                }
            }
            );
    });
});
