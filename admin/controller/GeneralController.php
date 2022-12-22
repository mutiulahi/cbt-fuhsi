<?php
session_start();

include '../../includes/database.php';

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
