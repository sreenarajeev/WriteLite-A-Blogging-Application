<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
   $select_user->execute([$email, $pass]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      $_SESSION['user_id'] = $row['id'];
      header('location:home.php');
   }else{
      $message[] = 'incorrect username or password!';
   }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/sign.css">
    <script src="https://kit.fontawesome.com/6133dcca2b.js" crossorigin="anonymous"></script>
    <title>SIGN IN</title>
</head>
<body>
    <div class="container">
        <img src="read.jpg">
        <div class="box">
            <br>
            <h1>Sign In</h1><br>
            <form action="" method="post">
                <div class="field">
                    <i style="color: rgb(0, 0, 0);  " class="fa-regular fa-user fa-bounce"></i>
                    <input type="email" name="email" id="" placeholder="E-Mail:" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')"><br><br>
                </div>
                <div class="field">
                    <i style="color: rgb(0, 0, 0);" class="fa-solid fa-unlock fa-bounce"></i>
                    <input type="password" name="pass" id="" placeholder="Password:" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
                </div>
                <br><br>
                <div class="cb">
                    <input type="checkbox" name="" id="">
                    <p>Remember Me</p>
                    <a href="forgot.php">Forgot Password?</a>
                </div>
                <input  type="submit" id ="button" name="submit" value="SUBMIT" ><br><br>
                <div class="lastline">
                    <p>Don't you have account? <a href="register.php">Sign Up</a></p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
