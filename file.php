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

use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Sum;

    include 'includes/database.php';
    //get total number of student that attempt each examinable subject
    $examination_array = [1, 2, 3, 4];
    $total_student = array();

    foreach ($examination_array as $key) {
        $sql = "SELECT COUNT(*) FROM check_subject WHERE examination_id = $key";
        $result = mysqli_query($dbconnect, $sql);
        $row = mysqli_fetch_assoc($result);
        $num = $row['COUNT(*)']/3;
        // round up the number
        $num = ceil($num);
       
        if ($key == 1) {
            echo "Total number of student that attempt Biology Language is: " . $num. "<br>";
        } elseif ($key == 2) {
            echo "Total number of student that attempt Chemistry is: " . $num . "<br>";
        } elseif ($key == 3) {
            echo "Total number of student that attempt English is: " . $num . "<br>";
        } elseif ($key == 4) {
            echo "Total number of student that attempt Physics is: " . $num . "<br>";
        }
        $total_student[] = $num;
    }

    echo "Total number of student that attempt the examination is: " . array_sum($total_student) . "<br>";


    // get total

    $total_user = "SELECT * FROM users";
    $total_user_result = mysqli_query($dbconnect, $total_user);
    $total_number = mysqli_num_rows($total_user_result);
    // echo "Total number of student that attempt the examination is: " . $total_number . "<br>";
    ?>
</body>

</html>