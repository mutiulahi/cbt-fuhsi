<?php
$dbconnect =  mysqli_connect('localhost', 'tescode', 'Fuhsi__123', 'cbt_fuhsi_db');
if($dbconnect->connect_errno){
    die("connection Failed: ".$dbconnect->connect_errno);
}
?>