<?php 

session_start();
include 'config.php';
if(isset($_POST['submit'])){
  
    $filter_name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = mysqli_real_escape_string($conn, $filter_name);

    $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $email = mysqli_real_escape_string($conn, $filter_email);

    $filter_pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
    $pass = mysqli_real_escape_string($conn, md5($filter_pass));

$_SESSION['name'] = $filter_name ;
    $select_users = mysqli_query($conn, "SELECT * FROM `user` WHERE email = '$email'") or die('query failed');
  
    if(mysqli_num_rows($select_users) > 0){
            header('location:user.php');
    }else{
        $message = 'incorrect password or email';
    }
    
}
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>

<?php
if(isset($message)){
    foreach($message as $message){
        echo '
        <div class="message">
     <span>'.$message.'</span>
     <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
 </div>
 ';
    }
}
?> 


    <section class="form_container"> 
        <form action-"" method="post">
       <h3>Login Now</h3>
        <input type="name" name="name" class="box" placeholder="Enter your User name" required> 
       <input type="email" name="email" class="box" placeholder="Enter your email address" required>
       <input type="password" name="pass" class="box" placeholder="Enter your password" required>
       
       <input type="submit" name="submit" class="btn"  value="Login Now">
       <p>Don't have an account ? <a href="register.php">Register</a></p>

        </form>
    </section>
    
</body>
</html>