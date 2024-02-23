<?php

// Enter your credentials
$dbhost = "";
$dbuser= "";
$dbpass = "";
$dbname = "taWebsite";
$connection = mysqli_connect($dbhost, $dbuser,$dbpass,$dbname);
if (mysqli_connect_errno()) {
     die("database connection failed :" .
     mysqli_connect_error() .
     "(" . mysqli_connect_errno() . ")"
         );
    }
?>