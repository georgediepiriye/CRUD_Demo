<?php
session_start();
if(isset($_GET['edit'])){
    $course_id = $_GET['edit'];
    include 'includes/DB_connection.inc.php';
    $sql= 'select * from courses where course_id=?;';
    $stmt = mysqli_stmt_init($connection);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("Location: home.php?error=stmterror");
                exit();
    }
    mysqli_stmt_bind_param($stmt,"s",$course_id);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
  
    $row=mysqli_fetch_assoc($result);

      
    
}else{
    header("Location: home.php");
}
?>

<h2>Edit Course</h2>
<form action="includes/edit_course.inc.php" method="post">
<input type="hidden" name="course_id" value="<?php echo $row['course_id']?>">
   <input type="text" name="coursename" value="<?php echo $row['coursename']?>"><br><br>
   <input type="text" name="track"  value="<?php echo $row['track']?>"><br><br>
   <input type="submit" name="update" value="Edit Course">
</form>