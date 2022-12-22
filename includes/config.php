<?php
// session_start();
// if (!isset($_SESSION['user_id'])) {
    header("Location: ../endsession.php?error=You have no access to this page please kindly login.");
// }
// else{
//     $user_id = $_SESSION['user_id'];
//     // get info from database
//     $get_user = $dbconnect->prepare("SELECT * FROM users WHERE jamb = ?");
//     $get_user->bind_param("s", $user_id);
//     $get_user->execute();
//     $result = $get_user->get_result();
//     $row = $result->fetch_assoc();
//     $user_id = $row['jamb'];
//     $name = $row['name'];
//     $email = $row['email'];
//     $phone = $row['phone'];
//     $image = $row['image'];
// }
