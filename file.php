<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!--  get total number of student that attempt subjects  -->
    <?php

    $dbconnect = mysqli_connect('localhost', 'root', '', 'cbt_fuhsi_db');
    if ($dbconnect->connect_errno) {
        die("connection Failed: " . $dbconnect->connect_errno);
    }

    $examination_array = [1, 2, 3, 4];
    foreach ($examination_array as $value) {
        $sql = "SELECT * FROM students_answers WHERE examination_id = '$value'";
        $result = mysqli_query($dbconnect, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
           // check exist in check_suject table 
           $USER = $row['user_id'];
            $sql2 = "SELECT * FROM check_subject WHERE user_id = '$USER'";
            $result2 = mysqli_query($dbconnect, $sql2);
            $row2 = mysqli_num_rows($result2);
            if ($row2 > 0) {
                // update
            } else {
                // insert
                $sql4 = "INSERT INTO check_subject (user_id, examination_id) VALUES ('$USER', '$value')";
                $result4 = mysqli_query($dbconnect, $sql4);
            }

            
           
        }
    }

    ?>