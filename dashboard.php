<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: index.php");
    exit;
}
include "includes/connection.php";
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css">
  </head>
  <body>
    <?php include "nav.php"; ?>
    <h1>Welcome Admin!</h1>
    <div class="m1" >
      <a href="manage-students.php" style="text-decoration:none">
      <div class="m11" style="text-decoration:none;height: 150px;background:linear-gradient(to right,rgb(128, 9, 23),rgb(230, 48, 60));border-radius: 5%;border:2px solid rgb(128, 9, 23)">
        No. of Students
        <p id="s1" style="font-size:28px">
        
        </p>

      </div>
      </a>
      
    </div>
    <div class="m2">
      <a href="manage-sem.php" style="text-decoration:none">
      <div class="m22" style="height: 150px;background:linear-gradient(to right,rgb(23, 5, 84),rgb(54, 78, 200));border-radius: 5%;border:2px solid rgb(23, 5, 84)">
        Semesters listed
        <p id="s2" style="font-size:28px">
        
        </p>
      </div></a>
      
    </div>
    <div class="m3">
      <a href="manage-branch.php" style="text-decoration:none" >
      <div class="m33" style="height: 150px;background:linear-gradient(to right,rgb(19, 89, 5),rgb(69, 179, 32));border-radius: 5%;border:2px solid rgb(19, 89, 5)">
        Branches listed
        <p id="s3" style="font-size:28px"> 
        
        </p>
      </div></a>

    </div>
    <div class="m4">
      <a href="manage-subjects.php" style="text-decoration:none">
      <div class="m44" style="margin:auto 350px auto;height: 150px;color:white;background:linear-gradient(to right,rgb(114, 82, 7),rgb(215, 186, 57));border-radius: 5%;border:2px solid rgb(23, 5, 84)">
        Subjects listed
        <p id="s4" style="font-size:28px">
        </p>
      </div></a>

    </div>
    <div class="m5">
      <a href="manage-results.php" style="text-decoration:none">
      <div class="m55" style="margin-right:350px;height: 150px;color:white;background:linear-gradient(to right,rgb(89, 8, 91),rgb(195, 45, 197));border-radius: 5%;border:2px solid rgb(23, 5, 84)">
        Results declared
        <p id="s5" style="font-size:28px">
        </p>
      </div></a>
      
    </div>
    <script>


function animateValue(obj, start, end, duration) {
  let startTimestamp = null;
  const step = (timestamp) => {
    if (!startTimestamp) startTimestamp = timestamp;
    const progress = Math.min((timestamp - startTimestamp) / duration, 1);
    obj.innerHTML = Math.floor(progress * (end - start) + start);
    if (progress < 1) {
      window.requestAnimationFrame(step);
    }
  };
  window.requestAnimationFrame(step);
}

const obj = document.getElementById("s1");
const obj1 = document.getElementById("s2");
const obj2 = document.getElementById("s3");
const obj3 = document.getElementById("s4");
const obj4 = document.getElementById("s5");


<?php
        $sql1 = "SELECT reg_id from student";
        $result1 = mysqli_query($conn,$sql1);
        $num1 = mysqli_num_rows($result1);

        $sql2 = "SELECT sem_id from semester";
        $result2 = mysqli_query($conn,$sql2);
        $num2 = mysqli_num_rows($result2);

        $sql3 = "SELECT branch_id from branch";
        $result3 = mysqli_query($conn,$sql3);
        $num3 = mysqli_num_rows($result3);

        $sql4 = "SELECT subj_id from subjects";
        $result4 = mysqli_query($conn,$sql4);
        $num4 = mysqli_num_rows($result4);

        $sql5 = "SELECT distinct roll_no from results";
        $result5 = mysqli_query($conn,$sql5);
        $num5 = mysqli_num_rows($result5);
        ?>
animateValue(obj, 0, <?php echo $num1; ?>, 800);
animateValue(obj1, 0, <?php echo $num2; ?>, 800);
animateValue(obj2, 0, <?php echo $num3; ?>, 800);
animateValue(obj3, 0, <?php echo $num4; ?>, 800);
animateValue(obj4, 0, <?php echo $num5; ?>, 800);

    </script>
  </body>
</html>