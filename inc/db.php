<?php
define('DB_NAME', 'spotify');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');

function db_conn(){
    $con = mysqli_connect("localhost", DB_USERNAME, DB_PASSWORD, DB_NAME);

    // Check connection
    if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      exit();
    }
    return $con;
}


?>
