<?php

$host="localhost";
$user="root";
$pass="";
$db="test";
$conn=new mysqli($host, $user, $pass, $db);
if($conn->connect_error){
    echo "Failed to conenct DB".$conn->connect_error;
}

?>