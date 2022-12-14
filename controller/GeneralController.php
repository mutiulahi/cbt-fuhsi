<?php
require "../vendor/autoload.php";

use Phpoffice\PhpSpreadsheet\Spreadsheet;
use Phpoffice\PhpSpreadsheet\Writer\Xlsx;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;




// uploading question to database
if (isset($_POST['upload_question'])) {
    $examination_id = $_POST['examination_id'];
    $file = $_FILES['file']['name'];
    $file_loc = $_FILES['file']['tmp_name'];
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file_loc);
    $sheetData = $spreadsheet->getActiveSheet()->toArray();

    foreach ($sheetData as $value) {
        $question[] =  $value[0];
        $option1[] =  $value[1];
        $option2[] =  $value[2];
        $option3[] =  $value[3];
        $option4[] =  $value[4];
        $correct_answer[] =  $value[5];
    }

    for ($i = 1; $i < sizeof($question); $i++) {

        $question = $question[$i];
        $options[] = $option1;
        $options[] = $option2;
        $options[] = $option3;
        $options[] = $option4;
        $insert_questions = "INSERT INTO questions (examination_id, question) VALUES ('$examination_id', '$question')";
        $insert_questions = mysqli_query($dbconnect, $insert_questions);
        if ($insert_questions) {
            $question_id = mysqli_insert_id($dbconnect);

            foreach ($options as $option) {
                $insert_options = "INSERT INTO options (examination_id, question_id, question_option) VALUES ('$examination_id', '$question_id', '$option')";
                $insert_options = mysqli_query($dbconnect, $insert_options);
            }
            $correct_answer = $_POST['correct_answer'];
            $insert_correct_answer = "INSERT INTO correct_answer (examination_id, question_id, correct_answer) VALUES ('$examination_id', '$question_id', '$correct_answer')";
            $insert_correct_answer = mysqli_query($dbconnect, $insert_correct_answer);
        }
    }
}
