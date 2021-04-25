<?php
?>
<h2>Registration form</h2><br>
<form action="includes/register.inc.php" method="post">
    <input type="text" name="firstname" placeholder="Enter First Name" required><br><br>
    <input type="text" name="lastname" placeholder="Enter Last Name" required><br><br>
    <input type="text" name="username" placeholder="Enter User Name" required><br><br>
    Gender: <input type="radio" name="gender" value="male" required>male
        <input type="radio" name="gender" value="female" >female<br><br>
        <input type="password" name='password' placeholder="Enter Password" required><br><br> 
        <input type="password" name="password_two" placeholder="Retype Password" required><br><br>
        <input type="submit" name="register" value="Register">
</form>
<a href="index.php">Login</a>

<?php
if(isset($_GET['error'])){
    if($_GET['error']==='emptyfield'){
       echo "<p style='color:red'>Fill all fields</p>";
    }elseif($_GET['error']==='invalidfirstname'){
        echo "<p style='color:red'>Enter a valid first name</p>";
    }elseif($_GET['error']==='invalidlastname'){
        echo "<p style='color:red'>Enter a valid last name</p>";
    }elseif($_GET['error']==='invalidusername'){
        echo "<p style='color:red'>Enter a valid user name</p>";
    }elseif($_GET['error']==='userexists'){
        echo "<p style='color:red'>User with this username already exists</p>";
    }elseif($_GET['error']==='invalidfirstname'){
        echo "<p style='color:red'>Enter a valid first name</p>";
    }elseif($_GET['error']==='passwordsdontmatch'){
        echo "<p style='color:red'>Both passwords don't match</p>";
    }
}