<?php
session_start();
require "../vendor/autoload.php";
include '../../includes/database.php';

use Phpoffice\PhpSpreadsheet\Spreadsheet;
use Phpoffice\PhpSpreadsheet\Writer\Xlsx;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

function IsSubmited($user_id, $examination_id)
{
    global $dbconnect;
    $check_subject = "SELECT * FROM check_subject WHERE user_id = '$user_id' AND examination_id = '$examination_id'";
    $check_subject = mysqli_query($dbconnect, $check_subject);
    $check_subject = mysqli_fetch_all($check_subject, MYSQLI_ASSOC);
    if (count($check_subject) > 0) {
        return 1;
    } else {
        return 0;
    }
}


// uploading question to database
if (isset($_POST['upload_question'])) {
    $examination_id = $_POST['examination_id'];
    $file = $_FILES['file']['name'];
    $file_loc = $_FILES['file']['tmp_name'];
    // check if file is excel file
    $file_ext = pathinfo($file, PATHINFO_EXTENSION);
    if ($file_ext != "xlsx") {
        header("Location: ../upload-question.php?type=error&msg=File must be excel file");
        exit();
    }

    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file_loc);
    $sheetData = $spreadsheet->getActiveSheet()->toArray();

    foreach ($sheetData as $value) {
        $question[] =  $value[0];
        $optionA[] =  $value[1];
        $optionB[] =  $value[2];
        $optionC[] =  $value[3];
        $optionD[] =  $value[4];
        $correct_answers[] =  $value[5];
    }
    // check if examination id already exist
    $check_examination = "SELECT * FROM questions WHERE examination_id = '$examination_id'";
    $check_examination = mysqli_query($dbconnect, $check_examination);
    $check_examination = mysqli_fetch_all($check_examination, MYSQLI_ASSOC);
    if (count($check_examination) > 0) {
        header("Location: ../upload-question.php?type=error&msg=Examination ID already exist");
        exit();
    }
    for ($i = 1; $i < sizeof($question); $i++) {
        $question_to_db = $question[$i];
        $options = array($optionA[$i], $optionB[$i], $optionC[$i], $optionD[$i]);
        $correct_answer = $correct_answers[$i];
        $question_to_db = mysqli_real_escape_string($dbconnect, $question_to_db);
        $correct_answer = mysqli_real_escape_string($dbconnect, $correct_answer);
        $insert_question = "INSERT INTO questions (examination_id, question) VALUES ('$examination_id', '$question_to_db')";
        $insert_question = mysqli_query($dbconnect, $insert_question);
        $question_id = mysqli_insert_id($dbconnect);
        // loop through options
        foreach ($options as $option) {
            $option = mysqli_real_escape_string($dbconnect, $option);
            $insert_option = "INSERT INTO options (examination_id, question_id, question_option) VALUES ('$examination_id','$question_id', '$option')";
            $insert_option = mysqli_query($dbconnect, $insert_option);
        }

        $insert_correct_answer = "INSERT INTO correct_options (examination_id, question_id, answer) VALUES ('$examination_id', '$question_id', '$correct_answer')";
        $insert_correct_answer = mysqli_query($dbconnect, $insert_correct_answer);
    }
    header("Location: ../upload-question.php?type=success&msg=Question uploaded successfully");
}

// login code 
if (isset($_POST['login'])) {
    // sanitize input data
    $email = mysqli_real_escape_string($dbconnect, $_POST['email']);
    $password = mysqli_real_escape_string($dbconnect, $_POST['password']);

    // check if email exist using prepared statement
    $check_email = $dbconnect->prepare("SELECT * FROM users WHERE email = ?");
    $check_email->bind_param("s", $email);
    $check_email->execute();
    $check_email = $check_email->get_result();
    $check_email = mysqli_fetch_all($check_email, MYSQLI_ASSOC);
    if (count($check_email) > 0) {
        if ($password == $check_email[0]['jamb']) {
            // check if user is admin
            if ($check_email[0]['role'] == '2') {
                // set session
                $_SESSION['auth_id'] = $check_email[0]['id'];
                $_SESSION['user_name'] = $check_email[0]['name'];
                $_SESSION['user_email'] = $check_email[0]['email'];
                $_SESSION['user_role'] = $check_email[0]['role'];
                header("Location: ../dashboard.php");
            } else {
                header("Location: ../index.php?type=error&msg=You are not an admin");
            }
        } else {
            header("Location: ../index.php?type=error&msg=Incorrect password");
        }
    } else {
        header("Location: ../index.php?type=error&msg=Email does not exist");
    }

}
