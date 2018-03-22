$(document).ready(function () {
    $('#btn-add').click(function () {
        var courseCode = $("#code").val();
        var courseName = $("#name").val();
        var courseData = {
            code: courseCode,
            name: courseName
        };

        if (!courseCode || courseCode.length != 6 || !courseCode.match(/^([A-Z]{2})([0-9]{4})$/)) {
            // Get the snackbar DIV
            var x = document.getElementById("snackbar");
            if (!courseCode) {
                $("#snackbar").html("Course code is required");
            }
            else if(courseCode.length != 6){
                $("#snackbar").html("Course code is invalid. The length must equal 6.");
            }
            else if(!courseCode.match(/^([A-Z]{2})([0-9]{4})$/)){
                $("#snackbar").html("Course code is invalid. The format must similar to CO1009");
            }
            $('#snackbar').css("background-color", "red");

            // Add the "show" class to DIV
            x.className = "show";

            // After 3 seconds, remove the show class from DIV
            return setTimeout(function () {
                x.className = x.className.replace("show", "");
            }, 3000);
        }

        if (!courseName || courseName.length > 50) {
            // Get the snackbar DIV
            var x = document.getElementById("snackbar");
            if (!courseName) {
                $("#snackbar").html("Course name is required");
            }
            else if(courseName.length > 50){
                $("#snackbar").html("Course name is invalid. The length can not exceed 50.");
            }
            $('#snackbar').css("background-color", "red");

            // Add the "show" class to DIV
            x.className = "show";

            // After 3 seconds, remove the show class from DIV
            return setTimeout(function () {
                x.className = x.className.replace("show", "");
            }, 3000);
        }

        if (courseCode != '' && courseName != '') {
            $.ajax
                ({
                    type: 'POST',
                    url: 'course.php',
                    data: courseData,
                    success: function (data, textStatus, xhr) {
                        console.log(xhr.status);
                        console.log(data);
                        if (xhr.status == 200) {
                            // Get the snackbar DIV
                            var x = document.getElementById("snackbar");
                            $("#snackbar").html("Course added successfully")

                            // Add the "show" class to DIV
                            x.className = "show";

                            // After 3 seconds, remove the show class from DIV
                            setTimeout(function () {
                                x.className = x.className.replace("show", "");
                            }, 3000);
                        }
                    },
                    error: function (xhr, textStatus, errorThrown) {
                        console.log(xhr.status);

                        if (xhr.status == 409) {
                            // Get the snackbar DIV
                            var x = document.getElementById("snackbar");
                            $("#snackbar").html("Course code existed!");
                            $('#snackbar').css("background-color", "red");

                            // Add the "show" class to DIV
                            x.className = "show";

                            // After 3 seconds, remove the show class from DIV
                            setTimeout(function () {
                                x.className = x.className.replace("show", "");
                            }, 3000);
                        }
                    }
                }
                );
        }
    });
});
