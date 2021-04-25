<?php 
 session_start();
 $username = $_SESSION['username'];
 
if(isset($_GET['status'])){
    if($_GET['status']==='passwordresetsuccessful'){
       echo "<p style='color:green'>Password reset Successful</p>";
    }elseif($_GET['status']==='coursedeleted'){
        echo "<p style='color:green'>Course Deleted Successfully</p>";
    }elseif($_GET['status']==='courseadded'){
        echo "<p style='color:green'>Course Added Successfully</p>";
    }elseif($_GET['status']==='courseedited'){
        echo "<p style='color:green'>Course Edited Successfully</p>";
    }

}

?>
<h2>Welcome <?=$_SESSION['username']  ?></h2><br><br>
<a href="includes/logout.php">Logout</a><br><br>
<a href="reset_password.php">Reset Password</a><br><br>
<a href="add_course.php">Add course</a><br><br>


    <?php
      require 'includes/DB_connection.inc.php';
      $sql = "select * from courses where username = ?;";
      $stmt = mysqli_stmt_init($connection);
      if(!mysqli_stmt_prepare($stmt,$sql)){
          header("Location: ../.php?error=stmtuserexists");
                  exit();
      }
      mysqli_stmt_bind_param($stmt,"s",$username);
      mysqli_stmt_execute($stmt);
  
      $result = mysqli_stmt_get_result($stmt);
      if(mysqli_num_rows($result)>0){
          ?>
         <table class="table" border="1px">
          <thead>
            <tr>
              <td>Course Name</td>
               <td>Track Name</td>
              <td colspan="2" align="center">Action</td>
            </tr>
            </thead>
            <tbody>
            <?php
             while($row=mysqli_fetch_assoc($result)): ?>
               
             <tr>
                <td><?php echo $row['coursename']?></td>
                <td><?php echo $row['track']?></td>
                <td><a href="edit_course.php?edit=<?php echo  $row["course_id"];?>">Edit</a></td>
                <td><a href="delete.php?delete=<?php echo  $row["course_id"];?>">Delete</a></td>
            </tr>
            <?php endwhile; ?>
             
            </tbody>
            </table>

         
          
<?php
      }
?>
    
       
       
      
