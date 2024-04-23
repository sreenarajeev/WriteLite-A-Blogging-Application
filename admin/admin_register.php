<?php

include '../components/connect.php';

session_start();

if(isset($_SESSION['admin_id'])){
   $admin_id = $_SESSION['admin_id'];
}else{
   $admin_id = '';
};

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $select_admin = $conn->prepare("SELECT * FROM `admin` WHERE name = ?");
   $select_admin->execute([$name]);
   $row = $select_admin->fetch(PDO::FETCH_ASSOC);

   if($select_admin->rowCount() > 0){
      $message[] = 'name already exists!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
         $insert_admin = $conn->prepare("INSERT INTO `admin`(name, password) VALUES(?,?)");
         $insert_admin->execute([$name, $cpass]);
         $select_admin = $conn->prepare("SELECT * FROM `users` WHERE name = ? AND password = ?");
         $select_admin->execute([$name, $cpass]);
         $row = $select_admin->fetch(PDO::FETCH_ASSOC);
         if($select_admin->rowCount() > 0){
            $_SESSION['admin_id'] = $row['id'];
            header('location:admin_login.php');
         }
      }
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
    <title>SIGN UP</title>
</head>
<body>
    <div class="container">
        <img src="write.jpg">
        <div class="box">
            <h1>Sign Up</h1>
            <form action="" method="post">
                <div class="field">
                    <i style="color: rgb(0, 0, 0);  " class="fa-regular fa-user fa-bounce"></i>
                    <input type="text" name="name" id="" placeholder="Username:" required >
                </div>
                <div class="field">
                    <i style="color: rgb(0, 0, 0);" class="fa-solid fa-unlock fa-bounce"></i>
                    <input type="password" name="pass" id="" placeholder="Password:" required maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
                </div>
                <div class="field">
                <i style="color: rgb(0, 0, 0);" class="fa-solid fa-unlock fa-bounce"></i>
                    <input type="password" name="cpass" id="" placeholder="Confirm Password" required maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
                </div>
                <div class="cb">
                    <input type="checkbox" name="submit" id=""> 
                    <p> Remember Me</p>
                    <a href="forgot.php">Forgot Password?</a>
                </div>
                <input  type="submit" id ="button" name="submit" value="SUBMIT">
                <div class="lastline">
                    <p>Already have an account?<a href="admin_login.php"> Sign In</a></p>
                </div>
            </form>
        </div>
        </div>
        <script src="../js/admin_script.js"></script>
  </body>
</html>