<?php
session_start();
include_once 'database.php';
if (isset($_POST['login'])) {

    $email_phone = mysqli_real_escape_string($dbconnect, $_POST['email_phone']);
    $jamb_registration_number = mysqli_real_escape_string($dbconnect, $_POST['jamb_registration_number']);

    $check_user = $dbconnect->prepare("SELECT * FROM users WHERE email = ? AND jamb = ?");
    $check_user->bind_param("ss", $email_phone, $jamb_registration_number);
    $check_user->execute();
    $result = $check_user->get_result();
    if ($result->num_rows === 0) {
        // redirect to login page
        header("Location: ../index.php?error=Invalide credentials please check and try again");
    } else {
        $get_user = $dbconnect->prepare("SELECT * FROM users WHERE jamb = ?");
        $get_user->bind_param("s", $jamb_registration_number);
        $get_user->execute();
        $result = $get_user->get_result();
        $row_success = $result->fetch_assoc();
        // if ($row_success['is_login'] == 1) {
        //     header("Location: ../index.php?error=You have been logged out from another device.");
        // } else {
            $datatime = date("Y-m-d H:i:s");
            $update_user_status = $dbconnect->prepare("UPDATE users SET is_login = 1, login_at = '$datatime' WHERE jamb = ?");
            $update_user_status->bind_param("s", $jamb_registration_number);
            $update_user_status->execute();
            $row = $result->fetch_assoc();
            $_SESSION['user_id'] = $row_success['jamb']; // user name
            header("Location: ../dashboard.php");
        // }
    }
}
