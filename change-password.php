<?php
session_start();
$showAlert = false;
$showError = false;
include "includes/connection.php";
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: index.php");
    exit;
}
else{
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $og_password = $_POST['ogpass'];
        $curr_password = $_POST['npass'];
        $concurr_password = $_POST['cnpass'];
        $username = $_SESSION['username'];
        // $hash_ogpass = password_hash($og_password, PASSWORD_DEFAULT);
        $sql = "SELECT * FROM `admin` WHERE username = '$username' ";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        if($num ==  1){
            while($row = mysqli_fetch_assoc($result)){
                if(password_verify($og_password, $row['password'])){
                    if(($curr_password == $concurr_password)){
                        $hash_pass = password_hash($curr_password, PASSWORD_DEFAULT);
                        $sql1 = "UPDATE `admin` SET password = '$hash_pass' WHERE username = '$username'";
                        $result1 = mysqli_query($conn, $sql1);
                        if($result1){
                            $showAlert = true;
                        }
                        else{
                            $showError = true;
                        }
                    }
                }
                else{
                    echo "Passwords do not match";
                }
            }
        }
        else{
            $showError = true;
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
 <!-- <link rel="stylesheet" href="css/form.css">  -->

    <title>Admin Change Password</title>
</head>
<body style="background-color : alicewhite; margin : 0">
<?php include "nav.php"; ?>
<?php
    if($showAlert){
        echo '<script>alert("Password Updated Successfully!")</script>';
    }
    if($showError){
        echo '<script>alert("Error! Try Again.")</script>';

    }
    ?>
    <div style="width : 67%; margin : auto auto; height : 500px; border : 2px solid rgb(200, 200, 200); margin-top : 80px;background-color: rgb(236, 236, 236)">
 <form method="post" >

    <h2 style="text-align:center; font-size : 30px">Admin Change Password</h2>

<div style=" width : 75%; margin:auto auto; font-size : 20px">
<p>
    <label for="ogpass">Current Password &nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;  
    <input name="ogpass" style="width : 50%;padding : 5px;font-size:17px"/>
</label>
    </p>
<p style="margin-top : 50px">
    <label for="npass">New Password  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;  
    <input name="npass" style="width : 50%;padding : 5px;font-size:17px"/>
</label>
    </p>
<p style="margin-top : 50px">
    <label for="cnpass">Confirm Password  &nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;  
    <input name="cnpass" style="width : 50%;padding : 5px;font-size:17px"/>
</label>
    </p>

</div>


<div style="float:right; margin-right : 80px">
    <button type="submit" style="width : 80px; padding : 7px;font-size : 17px; background-color : rgba(42, 42, 120, 0.909);color:white;">Change</button>

</div>

  </form>

    </div>

</body>
</html>