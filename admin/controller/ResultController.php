<?php
// include "../../includes/database.php";


function GetOption($id)
{
    global $dbconnect;
    $option = "SELECT * FROM options WHERE id = '$id'";
    $option_result = mysqli_query($dbconnect, $option);
    $option_result_row = mysqli_fetch_array($option_result, MYSQLI_ASSOC);
    return $option_result_row['question_option'];
}

// get 
// function Result()
// {
//     global $dbconnect;

//     $users = "SELECT * FROM users WHERE role = 0";
//     $users_result = mysqli_query($dbconnect, $users);
//     while ($users_result_row = mysqli_fetch_array($users_result)) {
//         $name = $users_result_row['name'];
//        $jamb = $users_result_row['jamb'];
//        $result = array();
//        $total_question_attempt = array();
//         $question = "SELECT * FROM students_answers INNER JOIN correct_options ON correct_options.question_id = students_answers.question_id WHERE students_answers.user_id = '$jamb'";
//         $reslt_question = mysqli_query($dbconnect, $question);
//         while ($row = mysqli_fetch_array($reslt_question)) {
//             $total_question_attempt[] = 1;
//             if(GetOption($row['option_id']) == $row['answer'] ) {
//                 $result[] = 1;
//             }
//         }
//         if(sizeof($total_question_attempt) >60){
//             $total_question_attempt = 60;
//         }else{
//             $total_question_attempt = sizeof($total_question_attempt);
//         }

//         if(sizeof($result) >60){
//             $result = 60;
//         }else{
//             $result = sizeof($result);
//         }
//         $respone [] = [$name,$jamb,$total_question_attempt,$result,'60'];
//     }

//     return $respone;
// }

// result function we pagenation 
function ResultPagination()
{
    global $dbconnect;

    $users = "SELECT * FROM users WHERE role = 0";
    $users_result = mysqli_query($dbconnect, $users);
    while ($users_result_row = mysqli_fetch_array($users_result)) {
        $name = $users_result_row['name'];
       $jamb = $users_result_row['jamb'];
       $result = array();
       $total_question_attempt = array();
        $question = "SELECT DISTINCT * FROM students_answers INNER JOIN correct_options ON correct_options.question_id = students_answers.question_id WHERE students_answers.user_id = '$jamb' AND students_answers.examination_id = 1";
        $reslt_question = mysqli_query($dbconnect, $question);
        while ($row = mysqli_fetch_array($reslt_question)) {
            $total_question_attempt[] = 1;
            if(GetOption($row['option_id']) == $row['answer'] ) {
                $result[] = 1;
            }
        }
        if(sizeof($total_question_attempt) >60){
            $total_question_attempt = 60;
        }else{
            $total_question_attempt = sizeof($total_question_attempt);
        }

        if(sizeof($result) >60){
            $result = 60;
        }else{
            $result = sizeof($result);
        }
        $respone [] = [$name,$jamb,$total_question_attempt,$result,'60'];
    }

    return $respone;
}
