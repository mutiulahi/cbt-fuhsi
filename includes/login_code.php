<?php
include_once 'database.php';
session_start();
// sensitizing the input
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
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['jamb']; // user name
        header("Location: ../dashboard.php");
    }
}
