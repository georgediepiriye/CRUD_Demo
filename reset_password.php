<?php

if(isset($_GET['error'])){
    if($_GET['error']==='emptyfield'){
       echo "<p style='color:red'>Fill all fields</p>";
    }elseif($_GET['error']==='incorrectpassword'){
        echo "<p style='color:red'>Password isn't correct</p>";
    }elseif($_GET['status']==='passwordsdontmatch'){
        echo "<p style='color:red'>New password and retyped password don't match</p>";
    }
}
?>
<h2>Reset Password</h2>
<form action="includes/reset_password.inc.php" method="post">
    <input type="password" name="current_password" placeholder="Enter Current Password"><br><br>
    <input type="password" name="new_password" placeholder="Enter New Password"><br><br>
    <input type="password" name="new_password_two" placeholder="Retype New Password"><br><br>
    <input type="submit" name="reset" value="Reset">

</form>