<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "FINAL";

$conn = mysqli_connect($servername,$username,$password,$database);
if(!$conn){
    die("Soorry : ".mysqli_connect_error());
}


?>