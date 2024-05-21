<?php
$servername="localhost";
$username="root";
$password="";
$database="sgp";
$con=mysqli_connect($servername,$username,$password,$database);
$conn1=mysqli_connect($servername,$username,$password,$database);
$conn2=mysqli_connect($servername,$username,$password,$database);


if (!$con) {
    die("sorry we failed to connect." . mysqli_connect_error());
} else {
    // echo "we connect to database";
}

?>