<?php
$dbconnect =  mysqli_connect('localhost', 'root', '', 'cbt_fuhsi_db');
if($dbconnect->connect_errno){
    die("connection Failed: ".$dbconnect->connect_errno);
}
?>