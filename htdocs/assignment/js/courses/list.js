$(document).ready(function () {
    $.ajax({
        type: 'GET',
        url: '/api/courses',
        dataType: 'json',
       
        complete: function (res) {
            if (res.status !== 200) {
                console.log(res)
            } else {
                console.log(res);
                console.log(res.responseJSON[0].name1);
            }
        }
    }
    );
});

 //contentType: "application/json",
        //dataType: "json",
       // data: JSON.stringify({id: 1}),    
        // success: function (res) { 
            
        //     console.log('meow');
        //     console.log(res);
        //     // $res= JSON.parse(data);
        //     console.log(res[0].name1);
        // },
        // error: function (xhr, textStatus, errorThrown) {
        //     console.log(errorThrown)
        //     console.log(xhr)
        //     console.log(textStatus)
        //     if (xhr.status == 200) {
        //         return displayToast('success', 'Listed');
        //     }
        // }