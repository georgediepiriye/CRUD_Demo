<?php

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    include "includes/DB_connection.inc.php";
    $sql = 'delete from courses where course_id=?;';
    $stmt = mysqli_stmt_init($connection);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("Location: home.php?error=stmtfailed");
                exit();
    }

  
    mysqli_stmt_bind_param($stmt,"s",$id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header('Location: home.php?status=coursedeleted');
    

}

