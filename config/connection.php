<?php

$host = "localhost";
$user = "titamulyana";
$pass = "";
$database = "digital_liblary";

$connection = mysqli_connect($host,$user,$pass,$database);
if(!$connection) {
    die("connection failed");
}
