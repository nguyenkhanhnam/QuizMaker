const toastConfig = [
    {
        type: 'error',
        background: 'red',
        color: 'white',
        duration: 1000
    },
    {
        type: 'success',
        background: 'black',
        color: 'white',
        duration: 1000
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

function getFormData($form) {
    var unindexedArray = $form.serializeArray()
    var indexedArray = {}
    $.map(unindexedArray, function (n, i) {
        indexedArray[n['name']] = n['value'].trim()
    })
    return indexedArray
}

function getStringDifficult(difficult) {
    if (difficult == 0)
        return 'Easy'
    if (difficult == 1)
        return 'Medium'
    if (difficult == 2)
        return 'Hard'
}

function getStringRole(role) {
    if (role == 0)
        return 'Admin'
    if (role == 1)
        return 'User'
    if (role == 2)
        return 'Staff'
}