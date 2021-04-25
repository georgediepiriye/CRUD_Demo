<?php
if(isset($_POST['reset'])){
    session_start();
    $current_password = trim($_POST['current_password']);
    $new_password = trim($_POST['new_password']);
    $new_password_two = trim($_POST['new_password_two']);
    $username = $_SESSION['username'];

  
    require 'DB_connection.inc.php';
    require 'functions.inc.php';

    if(emptyInputFieldPasswordReset($current_password,$new_password,$new_password_two)!==false){
        header("location: ../reset_password.php?error=emptyfield");
        exit();

    }

    if(incorrectCurrentPassword($connection,$username,$current_password)!==false){
        header("location: ../reset_password.php?error=incorrectpassword");
        exit();
    }

    if(passwordsDontMatch($new_password,$new_password_two)!==false){
        header("location: ../reset_password.php?error=passwordsdontmatch");
        exit();
    }

    resetPassword($connection,$username,$new_password);



}else{
    header("Location: ../reset_password.php");
    exit();
}
