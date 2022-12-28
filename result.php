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
    <link rel="stylesheet" href="css/fp.css">
</head>
<body>
    <nav>
    Result Management System
    </nav>
    <div class="m1">
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
        $sql = "SELECT t.Name, t.Roll_No, t.branch_id, t.sem_id, t.marks, subj_id, subjects.subj_name from (select sts.Name, sts.Roll_No, sts.branch_id, sts.sem_id, tr.marks,subj_id from students as sts join results as tr on tr.roll_no = sts.Roll_No) as t join subjects on subjects.subj_id = t.subj_id where (t.Roll_No = $stid and t.branch_id = $branch_id and t.sem_id = $sem_id) ";
$result = mysqli_query($conn, $sql);
// $num1 = mysqli_num_rows($result);
// echo "1";
// echo $num1;?>
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
                <th>#</th>
                <th>Subject</th>
                <th>Marks</th>
            </tr>
        </thead>
        <tbody>
<?php
// $sql = "SELECT t.Name, t.Roll_No, t.branch_id, t.sem_id, t.marks, subj_id, subjects.subj_name from (select sts.Name, sts.Roll_No, sts.branch_id, sts.sem_id, tr.marks,subj_id from students as sts join results as tr on tr.roll_no = sts.Roll_No) as t join subjects on subjects.subj_id = t.subj_id where (t.Roll_No = $stid and t.branch_id = $branch_id and t.sem_id = $sem_id) ";
// $result = mysqli_query($conn, $sql);
// $num1 = mysqli_num_rows($result);
// echo "1";
// echo $num1;
?>
        </tbody>
    </table>
<?php
}

?>
    </div>
</body>
</html>