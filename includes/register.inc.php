<?php 
  if(isset($_POST['register'])){
    $firstname =trim($_POST['firstname']) ;
    $lastname = trim($_POST['lastname']);
    $username = trim($_POST['username']);
    $gender = $_POST['gender'];
    $password =trim($_POST['password']);
    $password_two = trim($_POST['password_two']);

include 'functions.inc.php';
include 'DB_connection.inc.php';

       //checks if any input field is empty and and returns true if any is
      if(emptyInputFields($firstname,$lastname,$username,$password,$password_two)!== false){ 
          header('Location: ../register.php?error=emptyfield');
           exit();

       }

//checks if any firstname isnt a valid firstname and  returns true if any isnt
      if(invalidFirstName($firstname)!==false){
        header('Location: ../register.php?error=invalidfirstname');
        exit();

      }

      if(invalidLastName($lastname)!==false){
        header('Location: ../register.php?error=invaldidlastname');
        exit();

      }

      if(invalidUserName($username)!==false){
        header('Location: ../register.php?error=invalidusername');
        exit();

      }

      if(userExists($connection,$username)!==false){
        header('Location: ../register.php?error=userexists');
        exit();

      }

      if(passwordsDontMatch($password,$password_two)!==false){
        header('Location: ../register.php?error=passwordsdontmatch');
        exit();

      }

      createUser($connection,$firstname,$lastname,$username,$gender,$password);


      


  }else{
    header('Location: ../register.php');
    exit();

  }
