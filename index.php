<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WriteLite</title>
    <link href="https://fonts.googleapis.com/css2?family=Neuton&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Days+One&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/index.css">
    <script>
        $(document).ready(function(){
                $("#btn").click(function(){
                    $(".pop").fadeIn("slow");
                })
            })
    </script>
</head>
<body>
    <div class="backvideo">
    <video autoplay loop muted plays-inline class="backvideo" src="bgv.mp4"></video>
    <div class="heading">
        WRITELITE
    <div class="caption">
        <p>Write your own way, write what your heart speaks.</p>
        <p>Share your thoughts, knowledge, experience or the latest news.</p>
        <button id="btn">CREATE YOUR BLOG</button>
    </div>
    </div>
    <div class="pop">
       <a href="home.php" ><button id="su"> READ</button></a>
       <a href="admin/admin_register.php"><button id="si"> WRITE</button></a>
    </div>
</body>
</html>