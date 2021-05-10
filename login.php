<?php
session_start();
include "includes/header.php";
include "includes/database.php";
include "includes/functions.php";

if($_SERVER['REQUEST_METHOD'] == "POST")
{
  //something is posted
  $username= $_POST['username'];
  $password= $_POST['password'];

  if(!empty($username) && !empty($password) && !is_numeric($username))
  {
    //read from database
    //a function to generate a random user_id 
    $user_id= random_num(20);
    $query= "select * from users where username= '$username' limit 1" ;
    $result = mysqli_query($con, $query);
    
    if($result)
    {
      if($result && mysqli_num_rows($result)>0){
        $user_data= mysqli_fetch_assoc($result);
        
        if($user_data['password']=== $password) 
        {
          $_SESSION['user_id'] = $user_data['user_id'];
          header("Location: index.php");
          die;
        }
    }
    }
    echo "Wrong username or password!";
    
  }
  
  else
  { 
    echo " Please enter valid informations!"; 
    
  }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<form method="POST" style=" margin-right: 30%; margin-left: 20%; ">
  <div class="row mb-3">
    <label for="inputUsername" class="col-sm-2 col-form-label">Username</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="username">
    </div>
  </div>
  <div class="row mb-3">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" name="password">
    </div>
  </div>
  <div   class="row mb-3">
  You don't have an account? <a href="signup.php"> Sign up</a>
  </div>
  
  <button type="submit" class="btn btn-primary" value="login">Sign in</button>
</form>
</body>
</html>
