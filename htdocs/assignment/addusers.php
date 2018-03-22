<?php
require_once('./dbconnect.php');

$username = trim($_POST["username"], " \t\n\r\0\x0B");
$password = trim($_POST["password"], " \t\n\r\0\x0B");
$role_value = trim($_POST["role_value"], " \t\n\r\0\x0B");


// Create connection
//$conn = mysqli_connect($servername, $username, $password, $assignment);
// Check connection
/*if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}*/

$sql = "INSERT INTO users (username, password, role)
VALUES ('$username', '$password', '$role_value')";

if (mysqli_query($connection, $sql)) {
    echo "New record created successfully";
    return var_dump(http_response_code(200));
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($connection);
    return var_dump(http_response_code(409));
}

mysqli_close($connection);
?>