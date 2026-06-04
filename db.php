<?php
$conn= new mysqli("localhost","root","","school_management");
if($conn->connect_error){
    die("connection faild".$conn->connect_error);
}
?>