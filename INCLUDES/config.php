<?php

//Retrieve database info (outside of root folder)

$root = dirname($_SERVER['DOCUMENT_ROOT']).'/DBconn';

//echo $root;

// Create another constant to represent the final db connection file location
define('MYSQL',$root.'/2017_mysqli_connect.php');

// We are defining MYSQL as the constant for the filepath of the connection file. 
