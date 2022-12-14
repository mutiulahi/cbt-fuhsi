<?php
if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
    $page_no = $_GET['page_no'];
} else {
    $page_no = 1;
}

$total_question_par_page = 1;
$offset = ($page_no - 1) * $total_question_par_page;

function getQuestions($examination_id, $question_number)
{
    global $dbconnect;
    $questions = "SELECT * FROM questions WHERE examination_id = '$examination_id' ORDER BY RAND() LIMIT $question_number";
    $questions = mysqli_query($dbconnect, $questions);
    $questions = mysqli_fetch_all($questions, MYSQLI_ASSOC);
    return $questions;
}

function getOptions($question_id, $examination_id)
{
    global $dbconnect;
    $options = "SELECT * FROM options WHERE question_id = '$question_id' AND examination_id = '$examination_id' ORDER BY RAND()";
    $options = mysqli_query($dbconnect, $options);
    $options = mysqli_fetch_all($options, MYSQLI_ASSOC);
    return $options;
}
    
function getExaminations()
{
    global $dbconnect;
    $examination = "SELECT * FROM examinations";
    $examination = mysqli_query($dbconnect, $examination);
    $examination = mysqli_fetch_all($examination, MYSQLI_ASSOC);
    return $examination;
}

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