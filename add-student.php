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
        $fullname = $_POST['fullname'];
        $rollno = $_POST['rollno'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $dob = $_POST['birthDate'];
        $branch = $_POST['branch'];
        $sem = $_POST['semester'];
        $status = 1;
        $addsql = "INSERT INTO `student` (`Name`, `Roll_No`, `Email`, `Gender`, `DOB`, `branch_id`, `Reg_date`, `sem_id`, `status`) VALUES ('$fullname','$rollno', '$email', '$gender', '$dob', '$branch', current_timestamp(), '$sem', '$status') ";
        $result = mysqli_query($conn, $addsql);
        if($result){
            $showAlert = true;
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

    <title>Add Students</title>
</head>
<body style="background-color : alicewhite; margin : 0">
<?php include "nav.php"; ?>
<?php
    if($showAlert){
        echo '<script>alert("Record Added Successfully!")</script>';
    }
    if($showError){
        echo '<script>alert("Error! Try Again.")</script>';

    }
    ?>
    <div style="width : 70%; margin : auto auto; height : 800px; border : 2px solid rgb(200, 200, 200); margin-top : 15px;background-color: rgb(236, 236, 236)">
      <form method="post" >
<!--     <fieldset> -->
      <h2 style="text-align:center; font-size : 30px">Add Student Details</h2>
       
 
<div style=" width : 75%; margin:auto auto; font-size : 20px">
<p>
        <label for="fullname">Full name  &nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;  
    <input name="fullname" style="width : 50%;padding : 5px;font-size:17px"/>
</label>
      </p>
<p style="margin-top : 50px">
        <label for="rollno">Roll No &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp; 
     <input name="rollno" style="width : 50%;padding : 5px;font-size:17px"/>
    </label>
      </p>
 <p>
        <label for="email">Email &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :  &nbsp;&nbsp;
    <input type="email" name="email" style="width : 50%;padding : 5px;font-size:17px" />
</label>
      </p>
       
 
<p>
        Gender  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;
        <label><input type="radio" name="gender" value="Male" /> Male</label>
        <label><input type="radio" name="gender" value="Female" /> Female</label>
        <label><input type="radio" name="gender" value="Other" /> Other</label>
      </p>
 
 
 
 
       
 
<p>
        <label for="birthDate">DOB &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp; 
     <input type="date" name="birthDate" style="padding : 5px;font-size:17px; width : 180px"/></label>
      </p>
 
<div style="margin-left : 50px; margin-bottom:50px">
    <label for="branch">Branch &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp; </label>
    <select name="branch" id="branch" style = "padding : 5px; background-color : alicewhite; width:200px; font-size:17px">
        <option value="" style="font-size:15px">Select Branch</option>
        <?php 
        $sql = "SELECT * from `branch`";
        $result = mysqli_query($conn, $sql);
        // $sno = 0;
        // echo "1";
        while($row = mysqli_fetch_assoc($result)){
        ?>
            <option value="<?php echo $row['branch_id']; ?>" style="font-size:17px"><?php echo $row['branch'];?></option>

        <?php } ?>
        

        
    </select>
</div>

<div style="margin-left : 50px">
<label for="semester" >Semester &nbsp;&nbsp; :&nbsp;&nbsp;   </label>

    <select name="semester" id="semester" style = "padding : 5px; background-color : alicewhite; width:200px; font-size:17px">
        <option value="" style="font-size:15px">Select Semester</option>
        <?php 
        $sql = "SELECT * from `semester`";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
        ?>
            <option value="<?php echo $row['sem_id']; ?>" style="font-size:17px"><?php echo $row['semester'];?></option>

        <?php } ?>
        

        
    </select>
</div>
       

</div>

 
 
       
 <div style="float:right; margin-right : 80px">
        <button type="submit" style="width : 80px; padding : 7px;font-size : 17px; background-color : rgba(42, 42, 120, 0.909);color:white;">Add</button>

</div>

  </form>

    </div>

</body>
</html>