<?php
session_start();
?>
<h2>Add Course</h2>
<form action="includes/add_course.inc.php" method="post">
   <input type="text" name="course_name" placeholder="Enter course name"><br><br>
   <input type="text" name="track_name" placeholder="Enter track name"><br><br>
   <input type="submit" name="submit" value="Add Course">
</form>
<?php
if(isset($_GET['error'])){
    if($_GET['error']==='emptyfield'){
       echo "<p style='color:red'>Fill all fields</p>";
    }
}