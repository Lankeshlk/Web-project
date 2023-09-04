<?php
@include 'config.php';
if(isset($_POST['submit'])){

    $filter_name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $name = mysqli_real_escape_string($conn, $filter_name);

    $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $email = mysqli_real_escape_string($conn, $filter_email);

    $filter_pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
    $pass = mysqli_real_escape_string($conn, md5($filter_pass));

    $filter_cpass = filter_var($_POST['cpass'], FILTER_SANITIZE_STRING);
    $cpass = mysqli_real_escape_string($conn,  md5($filter_cpass));

    $select_users = mysqli_query($conn, "SELECT * FROM `user` WHERE email = '$email'") or die('query failed');
  
    if(mysqli_num_rows($select_users) > 0){
        $message[] = 'user already exists';
    }
    else{
        if($pass != $cpass){
            $message[] = 'Confirm password not matched!';
        }else{
            $insert_query = "INSERT INTO `user` (UserName, Email, Password) VALUES ('$name', '$email', '$pass')";
            mysqli_query($conn, $insert_query) or die('query failed');
            $message[] = 'Registered Successfully';
            header('location:login.php');
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
        <form action="" method="post">
       <h3>Register Now</h3>
       <input type="text" name="name" class="box" placeholder="Enter your Username" required>
       <input type="email" name="email" class="box" placeholder="Enter your email address" required>
       <input type="password" name="pass" class="box" placeholder="Enter your password" required>
       <input type="password" name="cpass" class="box" placeholder="Confirme your password" required>
       <input type="submit" name="submit" class="btn"  value="Register Now">
       <p>Already have an account? <a href="login.php">Login</a></p>
   
    </form>
    </section>
    
</body>
</html>








