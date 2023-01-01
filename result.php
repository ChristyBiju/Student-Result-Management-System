<?php
session_start();
include('includes/connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result</title>
    <!-- <link rel="stylesheet" href="css/fp.css"> -->
    <link rel="stylesheet" type="text/css" href="css/fp1.css?version=51">
</head>
<body>
    <nav>
    Result Management System
    </nav>
    <div class="m1" id="d1">
<?php
$stid = $_POST['stid'];
$branch_id = $_POST['branch_id'];
$sem_id = $_POST['sem_id'];
$sql = "SELECT student.Name, student.Roll_No, student.Reg_date, student.reg_id, branch.branch, semester.semester FROM student join branch on student.branch_id = branch.branch_id join semester on student.sem_id = semester.sem_id where student.Roll_No = $stid and student.branch_id = $branch_id and student.sem_id = $sem_id";
$result = mysqli_query($conn, $sql);
$num = mysqli_num_rows($result);
$c = 1;
if($num > 0){
    while($row = mysqli_fetch_assoc($result))
    {
?>
    <p><b>Student Name : </b><?php echo $row['Name'];?></p>
    <p><b>Student Roll No. : </b><?php echo $row['Roll_No'];?></p>
    <p><b>Student Branch : </b><?php echo $row['branch'];?></p>
    <p><b>Semester : </b><?php echo $row['semester'];?></p>
    
<?php

    }
    ?>
    <table>
        <thead>
            <tr>
                <th style="width : 8%; ">#</th>
                <th style="width : 60%; ">Subject</th>
                <th >Marks</th>
            </tr>
        </thead>
        <tbody>
<?php

 $sql = "SELECT student.Name, student.Roll_No, student.branch_id, student.sem_id, results.marks, results.subj_id, subjects.subj_name from results join student on student.Roll_No = results.roll_no join subjects on subjects.subj_id = results.subj_id where student.Roll_No = $stid and student.branch_id = $branch_id and student.sem_id = $sem_id and student.status=1 and subjects.status =1";
 $result = mysqli_query($conn, $sql);
$num1 = mysqli_num_rows($result);
$cnt = 1;
if($num1 > 0)
{
    while($row = mysqli_fetch_assoc($result)){
        ?>
        <tr>
            <td scope="row" ><?php echo $cnt ;?></td>
            <td ><?php echo $row['subj_name'];?></td>
            <td ><?php echo $total = $row['marks'];?></td>
        </tr>
        <?php
        $totalc += $total;
        $cnt++;
    }
    ?>
    <tr>
        <th scope="row" colspan="2" >Total Marks : </th>
        <td ><b><?php echo $totalc; ?></b>  out of  <b><?php echo ($outof = ($cnt - 1)*100);?></b></td>
    </tr>
    <tr>
        <th scope="row" colspan="2" >Percentage : </th>
        <td ><b><?php echo ($totalc*(100)/$outof);?>%</b></td>
    </tr>
    <tr>
    <th scope="row" colspan="2" >Download Result : </th>
        <td ><button style="background-color:white; font-size:18px" onclick="printDiv('d1','Title')">Download</button></td>
    </tr>
    <?php 
} else{?>
<div class="rnd">
                                            <strong>Notice!</strong> Your result is not declared yet
 <?php }
?>
                                        </div>
<?php
}else
{
    ?>
    <div class="inr">
<strong>Oh snap!</strong>
<?php
echo htmlentities("Invalid Roll Id");
}
?>
</div>
        </tbody>
    </table>

    </div>
    <div class="last">
        <a href="index.php">Back to Home</a>
    </div>
    <script>
        var doc = new jsPDF();


function printDiv(divId,
 title) {

 let mywindow = window.open('', 'PRINT', 'height=650,width=900,top=100,left=150');

 mywindow.document.write(`<html><head><title>${title}</title>`);
 mywindow.document.write('</head><body >');
 mywindow.document.write(document.getElementById(divId).innerHTML);
 mywindow.document.write('</body></html>');

 mywindow.document.close(); // necessary for IE >= 10
 mywindow.focus(); // necessary for IE >= 10*/

 mywindow.print();
 mywindow.close();

 return true;
}
    </script>
</body>
</html>