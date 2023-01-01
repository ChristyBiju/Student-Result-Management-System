<?php
session_start();
$showAlert = false;
$showError = false;
include "includes/connection.php";
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: index.php");
    exit;
}
$stid = intval($_GET['stid']);

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $fullname = $_POST['fullname'];
    $rollno = $_POST['rollno'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $dob = $_POST['birthDate'];
    $status = $_POST['status'];
    $addsql = "UPDATE `student` set student.Name = '$fullname', student.Roll_No = '$rollno', student.Email = '$email', student.Gender='$gender', student.DOB = '$dob', student.status='$status' where student.reg_id = '$stid'";
    $result1 = mysqli_query($conn, $addsql);
    if($result1){
        $showAlert = true;
    }
    else{
        $showError = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student's Info</title>
</head>
<body style=" margin : 0">
    <?php include "nav.php";?>
    <?php
    if($showAlert){
        echo '<script>alert("Record Updated Successfully!")</script>';
    }
    if($showError){
        echo '<script>alert("Error! Try Again.")</script>';

    }
    
    ?>
    <div style="width : 70%; margin : auto auto; height : 900px; border : 2px solid rgb(200, 200, 200); margin-top : 15px;background-color: rgb(236, 236, 236)">
    <h2 style="text-align:center; font-size : 30px">Student Admission Details</h2>

        <form method="post" >
    <?php
    $sql = "SELECT student.Name, student.Roll_No, student.reg_id,student.status,student.Email,student.Gender,student.Reg_date,student.DOB,branch.branch, semester.semester from student join branch on student.branch_id = branch.branch_id join semester on student.sem_id = semester.sem_id where student.reg_id = $stid";
    $result = mysqli_query($conn,$sql);
    $num = mysqli_num_rows($result);
    $c = 1;
    if($num > 0){
        while($row = mysqli_fetch_assoc($result)){
           ?>
           <div style=" width : 75%; margin:auto auto; font-size : 20px">
<p>
        <label for="fullname">Full name  &nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;  
    <input name="fullname" value="<?php echo $row['Name'];?>" style="width : 50%;padding : 5px;font-size:17px"/>
</label>
      </p>
<p style="margin-top : 50px">
        <label for="rollno">Roll No &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp; 
     <input name="rollno" value="<?php echo $row['Roll_No'];?>" style="width : 50%;padding : 5px;font-size:17px"/>
    </label>
      </p>
 <p>
        <label for="email">Email &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :  &nbsp;&nbsp;
    <input type="email" name="email" value="<?php echo $row['Email'];?>" style="width : 50%;padding : 5px;font-size:17px" />
</label>
      </p>
       
 
<p>
        Gender  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;
<?php 
$gndr = $row['Gender'];
if($gndr == "Male"){
    ?>
        <label><input type="radio" name="gender" value="Male" checked /> Male</label>
<label><input type="radio" name="gender" value="Female" /> Female</label>
        <label><input type="radio" name="gender" value="Other" /> Other</label>
<?php
}
?>
<?php
if($gndr == "Female"){
?>
        <label><input type="radio" name="gender" value="Male"  /> Male</label>
<label><input type="radio" name="gender" value="Female" checked/> Female</label>
        <label><input type="radio" name="gender" value="Other" /> Other</label>
<?php
}
?>
<?php
if($gndr == "Other"){
    ?>
            <label><input type="radio" name="gender" value="Male"  /> Male</label>
<label><input type="radio" name="gender" value="Female" /> Female</label>
        <label><input type="radio" name="gender" value="Other" checked/> Other</label>
<?php
}
?>
      </p>

 
 
 
       
 
<p>
        <label for="birthDate">DOB &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp; 
     <input type="date" name="birthDate" value="<?php echo $row['DOB'];?>" style="padding : 5px;font-size:17px; width : 180px"/></label>
      </p>
 
<div style="margin-left : 50px; margin-bottom:50px">
    <label for="branch">Branch &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp; 
    <input name="branch" value="<?php echo $row['branch'];?>" style="width : 50%;padding : 5px;font-size:17px" readonly/>
    </label>
    
        

        
    </select>
</div>

<div style="margin-left : 50px; margin-bottom:50px">
    <label for="semester">Semester &nbsp;&nbsp;&nbsp; :&nbsp;&nbsp; 
    <input name="semester" value="<?php echo $row['semester'];?>" style="width : 50%;padding : 5px;font-size:17px" readonly/>
    </label>
        

        
    </select>
</div>
<p>
        Reg Date &nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp; <?php echo $row['Reg_date'];?>
      </p>     

<!-- </div> -->
<p>
        Status  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;
<?php
$s = $row['status'];
if($s == 1){
    ?>
                <label><input type="radio" name="status" value="1" required="required" checked /> Active</label>
<label><input type="radio" name="status" value="0" required /> Block</label>
<?php
}?>
<?php
if($s == 0){
    ?>
                    <label><input type="radio" name="status" value="1" required="required" /> Active</label>
<label><input type="radio" name="status" value="0" required="required" checked /> Block</label>
<?php
}?>
</p>
 
 
       
 <div style="float:right; margin-right : 80px">
        <button type="submit" style="width : 90px; padding : 7px;font-size : 17px; background-color : rgba(42, 42, 120, 0.909);color:white;">Update</button>

</div>

  </form>
<?php
        }
    }
    ?>



    </div>
</body>
</html>