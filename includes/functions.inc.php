<?php


 //checks if any of the input fields are empty upon submission
function emptyInputFields($firstname,$lastname,$username,$password,$password_two){
    $result = true;
    if(empty($firstname) || empty($lastname) || empty($username) || empty($password) || empty($password_two)){
        $result = true;
    }else{
        $result = false;
    }
    return $result;
 }


   //checks if firstname is invalid and returns true if its invalid  
 function invalidFirstname($firstname){
          $result= true;
         $regex = '/^[a-zA-Z]*$/';
    //checks if the given firstname does not match the regular expression    
    if(!preg_match($regex,$firstname)){   
        $result = true;
    }else{
        $result = false;
    }
    return $result;
 }




  //checks if lastname is invalid and returns true if its invalid  
function invalidLastname($lastname){
    $result= true;
    $regex = '/^[a-zA-Z]*$/';
    if(!preg_match($regex,$lastname)){
        $result = true;
    }else{
        $result = false;
    }
    return $result;
}




  //checks if username is invalid and returns true if its invalid  
function invalidUsername($username){
    $result= true;
    $regex = '/^[a-zA-Z0-9]*$/';
    if(!preg_match($regex,$username)){
        $result = true;
    }else{
        $result = false;
    }
    return $result;
}



 //checks if the password and repeat password dont match are returns true if they dont
function passwordsDontMatch($password,$password_two){
    $result= true;

    if($password !== $password_two){
        $result = true;
    }else{
        $result = false;
    }
    return $result;
}



//checks if user with submitted username  exists in the database
function userExists ($connection,$username){
    $result = true;
    $sql = "select * from users where username = ?;";
    $stmt = mysqli_stmt_init($connection);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("Location: ../register.php?error=stmtuserexists");
                exit();
    }
    mysqli_stmt_bind_param($stmt,"s",$username);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
        $result = true;

    }else{
        $result = false;
       
    }
    return $result;
    mysqli_stmt_close($stmt);
 

}




//creates a new user
function createUser ($connection,$firstname,$lastname,$username,$gender,$password){
    require 'DB_connection.inc.php';
    $sql = "insert into users(firstname,lastname,username,gender,hash) values(?,?,?,?,?) ;";
    $stmt = mysqli_stmt_init($connection);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("Location: ../register.php?error=stmtfailed");
                exit();
    }

    $hashedPassword = password_hash($password,PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt,"sssss",$firstname,$lastname,$username,$gender,$hashedPassword);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header('Location: ../index.php?status=registered');
}



//checks if any input field is empty in login form
function emptyInputFieldLogin($username,$password){
    $result=true;
    if(empty($username) || empty($password)){
        $result = true;

    }else{
        $result = false;
    }
     return $result;
}




//logs user in
function loginUser($connection,$username,$password){
    //checks if user with given username exists
    $userExists = userExists($connection,$username);
    if($userExists===false){
        header("Location: ../login.php?status=wrongcredential");
        exit();
    }
    //gets the hash of the password of user with given username
    $hashedPassword = $userExists["hash"];
    //checks if inputed password is similar to 
    $checkedPassword = password_verify($password,$hashedPassword);
    
    if($checkedPassword === false){
        header("Location: ../index.php?status=wrongcredential");
        exit();

    }elseif($checkedPassword===true){
        session_start();
        $_SESSION['id'] = $userExists['id'];
        $_SESSION['username'] = $userExists['username'];
        header("Location: ../home.php");
       exit();

    }
}


//checks if any input field is empty in reset passport form
    function emptyInputFieldPasswordReset($current_password,$new_password,$new_password_two){
        $result=true;
        if(empty($current_password) || empty($new_password)|| empty($new_password_two)){
            $result = true;
    
        }else{
            $result = false;
        }
         return $result;
    }


    //checks if inputed current password is  not correct
     function incorrectCurrentPassword($connection,$username,$current_password){
        $result = true;
        $userExists = userExists($connection,$username);
        //gets the hash of the password of user with given username
    $hashedPassword = $userExists["hash"];
    //checks if inputed password is similar to password
    $checkedPassword = password_verify($current_password,$hashedPassword);
    if($checkedPassword==false){
       $result = true;
    }else{
        $result = false;
    }
    return $result;


 
    }



    //resets the user password
    function resetPassword($connection,$username,$new_password){
        require 'DB_connection.inc.php';
        $sql = "update users set hash=? where username=?";
        $stmt = mysqli_stmt_init($connection);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ../reset_password.php?error=stmtfailed");
                    exit();
        }
    
        $hashedPassword = password_hash($new_password,PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt,"ss",$hashedPassword,$username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header('Location: ../home.php?status=passwordresetsuccessful');

    }



    //checks if any input field is empty in login form
function emptyInputFieldCourse($course_name,$track_name){
    $result=true;
    if(empty($course_name) || empty($track_name)){
        $result = true;

    }else{
        $result = false;
    }
     return $result;
}


//adds a new course
function addCourse($connection,$course_name,$track_name,$username){
    require 'DB_connection.inc.php';
    $sql = "insert into courses(coursename,track,username) values(?,?,?) ;";
    $stmt = mysqli_stmt_init($connection);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("Location: ../add_course.php?error=stmtfailed");
                exit();
    }

    mysqli_stmt_bind_param($stmt,"sss",$course_name,$track_name,$username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header('Location: ../home.php?status=courseadded');
    

}



//updates edited course
function updateCourse($connection,$coursename,$track,$course_id){

    require 'DB_connection.inc.php';
    $sql = "update courses set coursename=?, track=? where course_id=?;";
    $stmt = mysqli_stmt_init($connection);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("Location: ../edit_course.php?error=stmtfailed");
                exit();
    }

    mysqli_stmt_bind_param($stmt,"sss",$coursename,$track,$course_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header('Location: ../home.php?status=courseedited');
    

}


