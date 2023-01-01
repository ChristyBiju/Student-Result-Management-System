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
if($_SERVER["REQUEST_METHOD"] == "POST")
{
$rowid=$_POST['id'];
$marks=$_POST['marks']; 

    foreach($_POST['id'] as $count){
        $mrks=$marks[$count - 1];
        $iid=$rowid[$count - 1];
            for($i=0;$i<=$count;$i++) {
                $sql = "UPDATE results set marks = $mrks where result_id = $iid";
                $result = mysqli_query($conn,$sql);
                $showAlert = true;

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
    <title>Student Result Info</title>
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
    <h2 style="text-align:center; font-size : 30px">Update Result info</h2>

        <form method="post" >
    <?php
    $sql = "SELECT student.Name,student.Roll_No,branch.branch , semester.semester from results join student on student.Roll_No = results.roll_no join subjects on subjects.subj_id = results.subj_id join branch on branch.branch_id = results.branch_id join semester on semester.sem_id = results.sem_id where student.reg_id  = $stid limit 1";
    $result = mysqli_query($conn,$sql);
    $num = mysqli_num_rows($result);
    $c = 1;

    if($num > 0){
        while($row = mysqli_fetch_assoc($result)){
           ?>
           <div style=" width : 75%; margin:auto auto; font-size : 20px">
<p style="margin-top : 30px">
        <label for="fullname">Full name  &nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;  
<?php echo $row['Name']; ?>
</label>
      </p>
<p style="margin-top : 50px">
        <label for="rollno">Roll No &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp; 
<?php echo $row['Roll_No']; ?>
</label>
      </p> 
 <p>
        <label for="class "> Class &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp; 
<?php echo ($row['branch']."   Sem(".$row['semester'].")"); ?>
</label>
      </p>
<?php
        }
    }
?>
<p style = "margin-top : 50px"></p>
<?php 
    $sql = "SELECT student.Name,student.Roll_No,branch.branch , semester.semester, results.marks, results.result_id, subjects.subj_name from results join student on student.Roll_No = results.roll_no join subjects on subjects.subj_id = results.subj_id join branch on branch.branch_id = results.branch_id join semester on semester.sem_id = results.sem_id where student.reg_id  = $stid ";
    $result = mysqli_query($conn,$sql);
    $num = mysqli_num_rows($result);
    $c = 1;
    if($num  > 0){
        while($row = mysqli_fetch_assoc($result)){
            ?>
            <p style="margin-top : 30px">
        <label for="default"><?php echo $row['subj_name']; ?>  :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  </label><br>
<input type="hidden" name="id[]" value="<?php echo  $row['result_id'];?>">
<input name="marks[]" id="marks" value="<?php echo $row['marks'];?>" maxlength="5" required="required" autocomplete="off" style="width : 50%;padding : 5px;font-size:17px; margin-left : 50px; margin-top:5px"/>

      </p>
<?php
        }
    }

?>
 <div style="float:right; margin-right : 80px">
        <button type="submit" style="width : 90px; padding : 7px;font-size : 17px; background-color : rgba(42, 42, 120, 0.909);color:white;">Update</button>

</div>

  </form>




    </div>
</body>
</html>