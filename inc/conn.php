<?php
$server="localhost";
$user="root";
$pass="";
$db="karakata";
$conn=new mysqli($server,$user,$pass,$db);
if($conn->connect_error)die($conn->connect_error);

function check($conn,$val){
return $conn->real_escape_string($val);
}
