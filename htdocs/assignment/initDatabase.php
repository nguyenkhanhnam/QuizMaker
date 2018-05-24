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
$mysql_database = 'assignment';

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
$index = 0;
// Loop through each line
foreach ($lines as $line){
// Skip it if it's a comment
	if (substr($line, 0, 2) == '--' || $line == '')
		continue;

	// Add this line to the current segment
	$templine .= $line;

	// If it has a semicolon at the end, it's the end of the query
	if (substr(trim($line), -1, 1) == ';'){
		// Perform the query
		mysqli_query($conn, $templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysqli_error($conn) . '<br /><br />');
		// Reset temp variable to empty
		$templine = '';
		if ($index == 0)
			echo "Tables users imported successfully <br>";
		if ($index == 1)
			echo "Tables courses imported successfully <br>";
		if ($index == 2)
			echo "Tables questions imported successfully <br>";
		$index = $index + 1;	
	}
}

if (!$conn->query("DROP PROCEDURE IF EXISTS sp_get_paper_question") ||
    !$conn->query("
					CREATE PROCEDURE `sp_get_paper_question`(IN `i_code` VARCHAR(6), IN `i_easy_number` INT(32) UNSIGNED, IN `i_medium_number` INT(32) UNSIGNED, IN `i_hard_number` INT(32) UNSIGNED)
					BEGIN
							SET @sql_text= concat(\"SELECT * FROM (\"
													, \" (SELECT * FROM `questions`\"
															, \" WHERE code= \'\", i_code, \"\' AND difficult= \'0\'\"
															, \" ORDER BY RAND() LIMIT \", i_easy_number, \")\"
												, \" UNION ALL\"
												, \" (SELECT * FROM `questions`\"
															, \" WHERE code= \'\", i_code, \"\' AND difficult= \'1\'\"
															, \" ORDER BY RAND() LIMIT \", i_medium_number, \")\"
												, \" UNION ALL\"
												, \" (SELECT * FROM `questions`\"
															, \" WHERE code= \'\", i_code, \"\' AND difficult= \'2\'\"
															, \" ORDER BY RAND() LIMIT \", i_hard_number, \")) AS T ORDER BY RAND()\"
												  );
							PREPARE stmt FROM @sql_text;
							EXECUTE stmt;
							DEALLOCATE PREPARE stmt;
						END")) {
    echo "Stored procedure creation failed: (" . $conn->errno . ") " . $conn->error;
}

if (!$conn->query("DROP FUNCTION IF EXISTS sf_get_username") ||
    !$conn->query("CREATE FUNCTION `sf_get_username`(`i_username` VARCHAR(32)) RETURNS varchar(32)
					BEGIN
					SET @username= i_username;
					SET @index= 1;
					getunameloop: LOOP
							SELECT COUNT(username) FROM `users` WHERE username= @username INTO @check_exist;
							IF @check_exist <> 0
							THEN
								SET @username= concat(i_username, @index);
								SET @index= @index+ 1;
								ITERATE getunameloop;
							END IF;
							LEAVE getunameloop;
					END LOOP getunameloop;
					 
					RETURN @username;
					END")) {
    echo "Stored function creation failed: (" . $conn->errno . ") " . $conn->error;
}

if (!$conn->query("DROP PROCEDURE IF EXISTS sp_set_account_info") ||
    !$conn->query("CREATE PROCEDURE `sp_set_account_info`(IN `i_role` VARCHAR(1), IN `i_fname` VARCHAR(16), IN `i_lname` VARCHAR(16), IN `i_mname` VARCHAR(20), IN `i_date_of_birth` VARCHAR(16), IN `i_address` VARCHAR(64), IN `i_phone` VARCHAR(16), IN `i_email` VARCHAR(64), OUT `o_username` VARCHAR(20), OUT `o_password` VARCHAR(8))
				BEGIN
					SET @d_date_of_birth := STR_TO_DATE(i_date_of_birth, \"%d/%m/%Y\");
					SET @username= concat(LOWER(substr(i_lname, 1, 1)), LOWER(substr(i_mname, 1, 1)), LOWER(i_fname));
					SET @username= sf_get_username(@username);
					SET @password= UNIX_TIMESTAMP()% 9000+ 1000;
					SET @hash_password= MD5(@password);
					  
					SET @sql_text= concat(\"INSERT INTO users (username, password, role, firstname, lastname, middlename, dateofbirth, address, phone, email) VALUES (\'\", @username, \"\', \'\", @hash_password
																		, \"\', \'\", i_role, \"\', \'\", i_fname
																		, \"\', \'\", i_lname, \"\', \'\", i_mname
																		, \"\', \'\", @d_date_of_birth, \"\', \'\", i_address
																		, \"\', \'\", i_phone, \"\', \'\", i_email
																		,\"\');\");
					PREPARE stmt FROM @sql_text;
					EXECUTE stmt;
					DEALLOCATE PREPARE stmt;
					
					SET o_username= @username;
					SET o_password= @password;

				END")) {
    echo "Stored procedure creation failed: (" . $conn->errno . ") " . $conn->error;
}

?>