<?php
$login = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'includes/connection.php';
    $username = $_POST["username"];
    $password = $_POST["password"]; 
    
     
    // $sql = "Select * from users where username='$username' AND password='$password'";
    $sql = "Select * from admin where username='$username'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1){
        while($row=mysqli_fetch_assoc($result)){
            if (password_verify($password, $row['password'])){ 
                $login = true;
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                header("location: dashboard.php");
            } 
            else{
                $showError = "Invalid Credentials";
            }
        }
        
    } 
    else{
        $showError = "Invalid Credentials";
    }
}
    
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SRMS</title>
    <link rel="shortcut icon" href="sample/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/index.css">
</head>

<body>
    <nav>
      College of Engineering Pune
    </nav>

    <div id="f2">
      <div id="f22" class="1">
         <div style="font-size : 30px ;border-bottom:solid gray 3px;padding:25px">
            For Students
         </div>
         <div style="padding-top:80px">
            <label for="click" style="font-size:25px">Search your result : </label>
            <!-- <div class="col-sm-6"> -->
               <a href="find-result.php" style="border:solid ForestGreen 2px ; padding:10px ; font-size:20px ; background-color:ForestGreen; color:white;text-decoration:none">Click here</a>
            <!-- </div> -->
         </div>
      </div>
        
    </div>
    <div id="f1">
      <div id="f11" class="1">
      <form action="" method="post">
      <div style="font-size : 30px ;border-bottom:solid gray 3px;padding:25px">
            Admin Login
         </div>
            <div  style="padding-top:45px">
                <label for="username" style="font-size:20px">Username</label>
                <input type="text" id="username" name="username"  required style="padding:7px; width : 400px; margin-left : 20px;font-size:17px">
            </div><br><br>
            <div style="padding-top:7px">
                <label for="password" style="font-size:20px">Password</label>
                <input type="password" id="password" name="password" required style="padding:7px; width : 400px; margin-left : 20px;font-size:15px">
            </div><br> 
         
            <div>
                <button type="submit" style="border:solid ForestGreen 2px ; padding:7px ; font-size:20px ; background-color:ForestGreen; color:white; width : 100px;">Login</button>
            </div>
        </form>
      </div>
        
    </div>
    <div class="clearfix"></div>
</body>

</html>