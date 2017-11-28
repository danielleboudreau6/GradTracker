<?php

/* 
This file will establish a MySQL database connection to the kpower database using
the MySQLi database driver.
*/

//setup database access info

define('DB_USER','gtuser');
define('DB_PASSWORD','password');
define('DB_HOST','localhost');
define('DB_NAME','gradtracker');

// make the connection

$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

var_dump($dbc);