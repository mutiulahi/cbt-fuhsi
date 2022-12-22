<?php
// redirect back 
if (!isset($_SESSION['auth_id'])) {
    header("Location: index.php?type=error&msg=You have no access to this page please kindly login.");
}
else{
    $user_id = $_SESSION['auth_id'];
    // get info from database
    $get_user = $dbconnect->prepare("SELECT * FROM users WHERE id = ?");
    $get_user->bind_param("s", $user_id);
    $get_user->execute();
    $result = $get_user->get_result();
    $row = $result->fetch_assoc();
    $name = $row['name'];
    $email = $row['email'];
    $phone = $row['phone'];
}
?>