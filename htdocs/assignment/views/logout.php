<?php   // Reference: https://stackoverflow.com/questions/10097887/using-sessions-session-variables-in-a-php-login-script
  session_start();
  echo "Logout Successfully ";
  session_destroy();   // function that Destroys Session 
  header("Location: /");
?>

