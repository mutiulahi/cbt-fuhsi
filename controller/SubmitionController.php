<?php
session_start();
include_once '../includes/database.php';

if (isset($_POST['submit_exam'])) {
    $check_ifsubmited = "SELECT * FROM check_subject WHERE user_id = '$_SESSION[user_id]' AND examination_id = '$_POST[examination_id]'";
    $check_ifsubmited = mysqli_query($dbconnect, $check_ifsubmited);
    $check_ifsubmited = mysqli_num_rows($check_ifsubmited);
    if ($check_ifsubmited > 0) {
        header("Location:../dashboard.php?message=already_submited");
        exit();
    } else {
        $user_id = $_SESSION['user_id'];
        $examination_id = $_POST['examination_id'];
        $questions = "SELECT * FROM questions WHERE examination_id = '$examination_id'";
        $questions = mysqli_query($dbconnect, $questions);
        $questions = mysqli_fetch_all($questions, MYSQLI_ASSOC);

        foreach ($_POST as $key => $value) {
            if ($key != 'submit_exam' and $key != 'examination_id') {
                $question_id = $key;
                $option_id = $value;
                $insert_answer = $dbconnect->prepare("INSERT INTO students_answers (question_id, option_id, user_id, examination_id) VALUES (?, ?, ?, ?)");
                $insert_answer->bind_param("iisi", $question_id, $option_id, $user_id, $examination_id);
                $insert_answer->execute();
            }
        }
        // insert to check_subject table
        $check_subject = "INSERT INTO check_subject (user_id, examination_id) VALUES ('$user_id', '$examination_id')";
        $check_subject = mysqli_query($dbconnect, $check_subject);
        header("Location:../dashboard.php?message=success");
    }
}
