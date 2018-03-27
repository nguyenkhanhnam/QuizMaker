$(document).ready(function () {
    $.ajax({
        type: 'GET',
        url: '/api/courses/',
        /*success: function (data, textStatus, xhr) {
            console.log(xhr.status)
            console.log('meow');
            if(xhr.status == 200){
                console.log(data);
            }
        },
        error: function (xhr, textStatus, errorThrown) {
            console.log(xhr)
            console.log(textStatus)
            if (xhr.status == 200) {
                return displayToast('success', 'Listed');
            }
        }*/
        complete: function (res) {
            if (res.status !== 200) {
                console.log(res)
            } else {
                console.log(res)
            }
        }
    }
    );
});