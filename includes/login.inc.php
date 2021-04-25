<?php
if(isset($_POST['login'])){

        $username = $_POST['username'];
        $password = $_POST['password'];
    
        require_once 'DB_connection.inc.php';
        require_once 'functions.inc.php';
    
        
        if(emptyInputFieldLogin($username,$password)!==false){
            header("Location: ../index.php?status=emptyfield");
            exit();
    
     }
    
          loginUser($connection,$username,$password);
    
    
    
    }else{
        header('Location: ../index.php');
        exit();
    }