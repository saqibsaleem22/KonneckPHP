<?php
//here all the information important to create a database connection we will use this file
//everytime we need to create a connection with our database
$host_db = "localhost";
$login_db = "root";
$password_db = "";
$db = "konneck";
$con = mysqli_connect($host_db,$login_db,$password_db,$db) or die("Unable to connect to database");
