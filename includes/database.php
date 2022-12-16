<?php
// $dbconnect = mysqli_connect('localhost', 'root', '', 'cbt_fuhsi_db');
// if (mysqli_connect_errno()) {
//     echo "Connection failed:".mysqli_connect_error();
//     exit;
// }

$dbconnect = new mysqli('localhost', 'root', '', 'cbt_fuhsi_db');

    if(mysqli_connect_errno()){
        die("connection Failed: ".mysqli_connect_errno());
    }