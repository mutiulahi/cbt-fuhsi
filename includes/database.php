<?php
$dbconnect =  mysqli_connect('localhost', 'tescode', 'fuhsi@@__cbt', 'cbt_fuhsi_db');
if($dbconnect->connect_errno){
    die("connection Failed: ".$dbconnect->connect_errno);
}