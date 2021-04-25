<?php

  
if(isset($_GET['status'])){
    if($_GET['status']==='emptyfield'){
       echo "<p style='color:red'>Fill all fields</p>";
    }elseif($_GET['status']==='wrongcredential'){
        echo "<p style='color:red'>Wrong credentials</p>";
    }elseif($_GET['status']==='registered'){
        echo "<p style='color:green'>Registration Successful,please login</p>";
    }
}
 

?>
<h2>Login</h2><br>
  <form action="includes/login.inc.php" method="post">
       Username: <input type="text" name="username" required><br><br>
       Password: <input type="password" name="password" required><br><br>
       <input type="submit" name="login" value="Login">
  </form>
  <a href="register.php">Register</a>


  
   