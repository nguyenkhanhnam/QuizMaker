const toastConfig = [
    {
        type: 'error',
        background: 'red',
        color: 'white',
        duration: 2000
    },
    {
        type: 'success',
        background: 'black',
        color: 'white',
        duration: 2000
    }
]

function displayToast(type, text) {
    var toast = toastConfig.find(item => item.type === type);

    // Get the snackbar DIV
    var x = document.getElementById("snackbar");

    // Set html and style of the snackbar
    $("#snackbar").html(text);
    $('#snackbar').css("background-color", toast.background);
    $('#snackbar').css("color", toast.color);

    // Add the "show" class to DIV
    x.className = "show";

    // Disable mouse click event on tag button. Ref: https://stackoverflow.com/a/25627366
    $('button').css("pointer-events", "none");

    // After 3 seconds, remove the show class from DIV
    setTimeout(function () {
        // Enable mouse click event on tag button
        $('button').css("pointer-events", "auto");

        x.className = x.className.replace("show", "");
    }, toast.duration);
};

function displayToastWithRedirect(type, text, redirect) {
    console.log(type);
    var toast = toastConfig.find(item => item.type === type);

    // Get the snackbar DIV
    var x = document.getElementById("snackbar");

    // Set html and style of the snackbar
    $("#snackbar").html(text);
    $('#snackbar').css("background-color", toast.background);
    $('#snackbar').css("color", toast.color);

    // Add the "show" class to DIV
    x.className = "show";

    // Disable mouse click event on tag button. Ref: https://stackoverflow.com/a/25627366
    $('button').css("pointer-events", "none");

    // After 3 seconds, remove the show class from DIV
    setTimeout(function () {
        // Enable mouse click event on tag button
        $('button').css("pointer-events", "auto");

        x.className = x.className.replace("show", "");
        window.location.href = redirect;
    }, toast.duration);
};

