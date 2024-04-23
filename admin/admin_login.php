<?php

include '../components/connect.php';

session_start();

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_admin = $conn->prepare("SELECT * FROM `admin` WHERE name = ? AND password = ?");
   $select_admin->execute([$name, $pass]);
   
   if($select_admin->rowCount() > 0){
      $fetch_admin_id = $select_admin->fetch(PDO::FETCH_ASSOC);
      $_SESSION['admin_id'] = $fetch_admin_id['id'];
      header('location:dashboard.php');
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
    <link rel="stylesheet" href="../css/sign.css">
    <script src="https://kit.fontawesome.com/6133dcca2b.js" crossorigin="anonymous"></script>
    <title>SIGN IN</title>
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
    <div class="container">
        <img src="write.jpg">
        <div class="box">
            <br>
            <h1>Sign In</h1><br>
            <form action="" method="post">
                <div class="field">
                    <i style="color: rgb(0, 0, 0);  " class="fa-regular fa-user fa-bounce"></i>
                    <input type="name" name="name" id="" placeholder="Username:" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')"><br><br>
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
                    <p>Don't you have account? <a href="admin_register.php">Sign Up</a></p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
