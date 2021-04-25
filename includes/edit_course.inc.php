<?php 
if(isset($_POST['update'])){
    $course_id = $_POST['course_id'];
    $coursename = $_POST['coursename'];
    $track = $_POST['track'];


    include 'DB_connection.inc.php';
    include 'functions.inc.php';

    
 updateCourse($connection,$coursename,$track,$course_id);
    

}else{
    header("Location: ../edit_course.php");
    exit();
}