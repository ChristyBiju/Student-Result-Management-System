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
        $marks = array();
        $branch_id = $_POST['branch'];
        $sem_id = $_POST['semester'];
        $st_id = $_POST['studentid'];
        $mark = $_POST['marks'];

        $sql = "SELECT subjects.subj_name, subjects.subj_id FROM subject_comb join subjects on subjects.subj_id = subject_comb.subj_id WHERE subject_comb.sem_id = $sem_id order by subjects.subj_name";
        $result = mysqli_query($conn, $sql);
        $sid1 = array();

        while($row = mysqli_fetch_assoc($result)){
            array_push($sid1, $row['subj_id']);
        }

        for($i = 0; $i < count($mark); $i++){
            $mar = $mark[$i];
            $sid = $sid1[$i];
            $sql = "INSERT INTO results (roll_no, branch_id, sem_id, subj_id, marks) VALUES ('$st_id','$branch_id', '$sem_id', '$sid', '$mar')";
            
            $result = mysqli_query($conn, $sql);


            if($result){
                $showAlert = true;
            }
            else{
                $showError = true;
            }
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

    <title>Declare Result</title>
    <script src="js/modernizr/modernizr.min.js"></script>
    
    <script>
function getStudent(val,branch_id) {
var branch_id=$(".branch_id").val();
var val=$(".clid").val();;
var abh=branch_id+'$'+val;
    $.ajax({
    type: "POST",
    url: "get_student.php",
    data:'classid='+abh,

    success: function(data){
        $("#studentid").html(data);   
    }
    // error: function(data){ console.log('my message'); }
    });
$.ajax({
        type: "POST",
        url: "get_student.php",
        data:'classid1='+abh,
        success: function(data){
            $("#subject").html(data);
            
        }
        });
}
    </script>
<script>

function getresult(val,clid,branch_id) 
{   
var branch_id = $(".branch_id").val();
var clid=$(".clid").val();
var val=$(".stid").val();;
var abh=clid+'$'+val+'$'+branch_id;
//alert(abh);
    $.ajax({
        type: "POST",
        url: "get_student.php",
        data:'studclass='+abh,
        success: function(data){
            $("#reslt").html(data);
            
        }
        });
}
</script>

</head>
<body style="background-color : alicewhite; margin : 0">
<?php include "nav.php"; ?>
<?php
    if($showAlert){
        echo '<script>alert("Result Declared Successfully!")</script>';
    }
    if($showError){
        echo '<script>alert("Error! Try Again.")</script>';

    }
    ?>
    <div style="width : 70%; margin : auto auto; height : 1400px; border : 2px solid rgb(200, 200, 200); margin-top : 20px;background-color: rgb(236, 236, 236)">
      <form method="post" >
<!--     <fieldset> -->
      <h2 style="text-align:center; font-size : 30px">Declare Result</h2>
       
 
<div style=" width : 75%; margin:auto auto; font-size : 20px">

<div style="margin-left : 50px; margin-bottom:50px">
    <label for="branch">Branch &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : </label>
    <select name="branch" class="branch_id" id="branch" style = "padding : 5px; background-color : alicewhite; width:80%; font-size:17px">
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
<label for="semester" >Semester &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :  </label>

    <select class = "clid" name="semester" id="classid" style = "padding : 5px; background-color : alicewhite; width:80%; font-size:17px" onChange="getStudent(this.value);">
        <option value="" style="font-size:17px">Select Semester</option>
        <?php 
        $sql = "SELECT * from `semester`";
        $result = mysqli_query($conn, $sql);
        // $sno = 0;
        // echo "1";
        while($row = mysqli_fetch_assoc($result)){
        ?>
            <option value="<?php echo $row['semester']; ?>" style="font-size:17px"><?php echo $row['semester'];?></option>

        <?php } ?>
        

        
    </select>
</div>
<div style="margin-left : 50px;margin-bottom:50px">
<label for="semester" >Student Name  :   </label>

    <select class = "stid" name="studentid" id="studentid" style = "padding : 5px; background-color : alicewhite; width:80%; font-size:17px" onChange="getresult(this.value);">
      
    </select>
</div>
<div>
    <div id="reslt">

    </div>
</div>
<div style="margin-left : 50px;margin-bottom:50px">
<label for="date" class="col-sm-2 control-label">Subjects : </label>
                                                        <div class="col-sm-10">
                                                    <div  id="subject" name = "date">
                                                    </div>
                                                        </div>
                                                    </div>

</div>

 
 
       
 <div style="float:right; margin-right : 80px">
        <button type="submit" style="width : 150px; padding : 7px;font-size : 17px; background-color : rgba(42, 42, 120, 0.909);color:white;">Declare Result</button>

</div>

  </form>

    </div>
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <!-- <script src="js/bootstrap/bootstrap.min.js"></script> -->
        <!-- <script src="js/pace/pace.min.js"></script> -->
        <!-- <script src="js/lobipanel/lobipanel.min.js"></script> -->
        <!-- <script src="js/iscroll/iscroll.js"></script> -->
        <!-- <script src="js/prism/prism.js"></script> -->
        <!-- <script src="js/select2/select2.min.js"></script> -->
        <!-- <script src="js/main.js"></script> -->
        <script>
            $(function($) {
                $(".js-states").select2();
                $(".js-states-limit").select2({
                    maximumSelectionLength: 2
                });
                $(".js-states-hide").select2({
                    minimumResultsForSearch: Infinity
                });
            });
        </script>
</body>
</html>