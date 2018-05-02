<?php
// Name of the file
$filename = './data/init.sql';
// MySQL host
$mysql_host = 'localhost';
// MySQL username
$mysql_username = 'root';
// MySQL password
$mysql_password = '';
// Database name
$mysql_database = 'ass2';

// Create connection
$conn = new mysqli($mysql_host, $mysql_username, $mysql_password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "DROP DATABASE $mysql_database";
if ($conn->query($sql) === TRUE) {
    echo "Database deleted successfully <br>";
} else {
    echo "Error deleting database: " . $conn->error . "<br>";
}

// Create database
$sql = "CREATE DATABASE $mysql_database";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully <br>";
} else {
    echo "Error creating database: " . $conn->error . "<br>";
}

$conn->close();

// Connect to MySQL server
$conn = mysqli_connect($mysql_host,$mysql_username,$mysql_password,$mysql_database) or die('Error connecting to MySQL server: ' . mysql_error());
// Select database
//mysqli_select_db($mysql_database) or die('Error selecting MySQL database: ' . mysql_error());

// Temporary variable, used to store current query
$templine = '';
// Read in entire file
$lines = file($filename);
// Loop through each line
foreach ($lines as $line)
{
// Skip it if it's a comment
if (substr($line, 0, 2) == '--' || $line == '')
    continue;

// Add this line to the current segment
$templine .= $line;
// If it has a semicolon at the end, it's the end of the query
if (substr(trim($line), -1, 1) == ';')
{
    // Perform the query
    mysqli_query($conn, $templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysqli_error($conn) . '<br /><br />');
    // Reset temp variable to empty
    $templine = '';
}
}
// echo "Tables imported successfully";

if (!$conn->query("DROP PROCEDURE IF EXISTS get_paper_question") ||
    !$conn->query("
					CREATE PROCEDURE `get_paper_question`(IN `i_code` VARCHAR(6), IN `i_easy_number` INT(32) UNSIGNED, IN `i_medium_number` INT(32) UNSIGNED, IN `i_hard_number` INT(32) UNSIGNED)
					BEGIN
							SET @sql_text= concat(\"(SELECT * FROM `questions`\"
															, \" WHERE code= \'\", i_code, \"\' AND difficult= \'0\'\"
															, \" ORDER BY RAND() LIMIT \", i_easy_number, \")\"
												, \" UNION ALL\"
												, \" (SELECT * FROM `questions`\"
															, \" WHERE code= \'\", i_code, \"\' AND difficult= \'1\'\"
															, \" ORDER BY RAND() LIMIT \", i_medium_number, \")\"
												, \" UNION ALL\"
												, \" (SELECT * FROM `questions`\"
															, \" WHERE code= \'\", i_code, \"\' AND difficult= \'2\'\"
															, \" ORDER BY RAND() LIMIT \", i_hard_number, \")\"
												  );
							PREPARE stmt FROM @sql_text;
							EXECUTE stmt;
							DEALLOCATE PREPARE stmt;
						END")) {
    echo "Stored procedure creation failed: (" . $conn->errno . ") " . $conn->error;
}

// if (!$conn->multi_query("CALL p()")) {
    // echo "CALL failed: (" . $conn->errno . ") " . $conn->error;
// }

?>