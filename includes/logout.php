<?php
// logout 
session_start();
session_destroy();
header("Location: ../index.php?type=success&msg=You have successfully logged out");
