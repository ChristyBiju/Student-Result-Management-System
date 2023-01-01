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
        $branch_id = $_POST['branch'];
        $sem_id = $_POST['semester'];
        $subj_id = $_POST['subject'];
        $stat = 1 ;
        $addsql = "INSERT INTO `subject_comb` (`branch_id`, `sem_id`, `subj_id`,`status`) VALUES ('$branch_id','$sem_id','$subj_id', '$stat') ";
        
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

    <title>Add Subject Combination</title>
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
    <div style="width : 70%; margin : auto auto; height : 500px; border : 2px solid rgb(200, 200, 200); margin-top : 80px;background-color: rgb(236, 236, 236)">
      <form method="post" >
<!--     <fieldset> -->
      <h2 style="text-align:center; font-size : 30px">Add Subject Combination</h2>
       
 
<div style=" width : 75%; margin:auto auto; font-size : 20px">

<div style="margin-left : 50px; margin-bottom:50px">
    <label for="branch">Branch &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp; </label>
    <select name="branch" id="branch" style = "padding : 5px; background-color : alicewhite; width:80%; font-size:17px">
        <option value="" style="font-size:17px">Select Branch</option>
        <?php 
        $sql = "SELECT * from `branch`";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
        ?>
            <option value="<?php echo $row['branch_id']; ?>" style="font-size:17px"><?php echo $row['branch'];?></option>

        <?php } ?>
        

        
    </select>
</div>

<div style="margin-left : 50px;margin-bottom:50px">
<label for="semester" >Semester &nbsp;&nbsp; :&nbsp;&nbsp;   </label>

    <select name="semester" id="semester" style = "padding : 5px; background-color : alicewhite; width:80%; font-size:17px">
        <option value="" style="font-size:17px">Select Semester</option>
        <?php 
        $sql = "SELECT * from `semester`";
        $result = mysqli_query($conn, $sql);
        // $sno = 0;
        // echo "1";
        while($row = mysqli_fetch_assoc($result)){
        ?>
            <option value="<?php echo $row['sem_id']; ?>" style="font-size:17px"><?php echo $row['semester'];?></option>

        <?php } ?>
        

        
    </select>
</div>
<div style="margin-left : 50px;margin-bottom:50px">
<label for="subject" >Subject &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp;   </label>

    <select name="subject" id="subject" style = "padding : 5px; background-color : alicewhite; width:80%; font-size:17px">
        <option value="" style="font-size:17px">Select Subject</option>
        <?php 
        $stat = 1;
        $sql = "SELECT * from `subjects` where subjects.status = '$stat'";
        $result = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_assoc($result)){
        ?>
            <option value="<?php echo $row['subj_id']; ?>" style="font-size:17px"><?php echo $row['subj_name'];?></option>

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