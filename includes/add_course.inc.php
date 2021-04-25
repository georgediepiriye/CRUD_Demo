<?php
  if(isset($_POST['submit'])){
      session_start();
      $course_name = trim($_POST['course_name']);
      $track_name = trim($_POST['track_name']);
      $username = $_SESSION['username'];

      
include 'functions.inc.php';
include 'DB_connection.inc.php';


      if(emptyInputFieldCourse($course_name,$track_name)!==false){
          header('Location: ../add_course.php?error=emptyfield');
          exit();
      }

      addCourse($connection,$course_name,$track_name,$username);




  }else{
      header('Location: ../add_course.php');
      exit();
  }
