<?php


include('includes/connection.php');
if(!empty($_POST["classid"])) 
{
    $id_1= $_POST['classid'];
    $dta=explode("$",$id_1);
   $branch_id=intval($dta[0]);
   $cid=intval($dta[1]);
 if(!is_numeric($cid) || !is_numeric($branch_id) ){
 
 	echo htmlentities("Invalid");
    exit;
 }
 else{
    // $classid = intval($_POST['classid']);
    $sql1 = "SELECT student.Name, Roll_No FROM `student` WHERE sem_id = '$cid' and branch_id = '$branch_id' and student.status = 1 order by Name";
    $result = mysqli_query($conn, $sql1);
    ?>
    <option value="">Select Name</option>
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
        
        ?>
        <option value="<?php echo $row['Roll_No']; ?>"><?php echo $row['Name'];?></option>
        <?php
    }
}

}
// Code for Subjects
if(!empty($_POST["classid1"])) 
{
    // echo "DONE";
    $id_2= $_POST['classid1'];
    $dta=explode("$",$id_2);
   $branch_id1=intval($dta[0]);
   $cid1=intval($dta[1]);

//  $cid1=intval($_POST['classid1']);
 if(!is_numeric($cid1) || !is_numeric($branch_id1)){
 
  echo htmlentities("Invalid Class");exit;
 }
 else{

    $sql2 = "SELECT * FROM subject_comb, subjects where subjects.subj_id = subject_comb.subj_id and subject_comb.sem_id = $cid1 and subject_comb.branch_id = $branch_id1 order by subjects.subj_name";
    $result1 = mysqli_query($conn, $sql2);
    
    while($row = mysqli_fetch_assoc($result1)){
        
    ?>
    <p style="margin-left:120px; font-size : 17px;">
        <?php echo $row['subj_name'];?><br>
        <input type="text" name = "marks[]" value="" required="" placeholder="Enter marks out of 100" autocomplete="off" style="width : 96%; padding:5px;font-size:17px;margin-top:5px">
    </p>
    <?php
    }
}
}


?>

<?php

if(!empty($_POST["studclass"])) 
{

// echo "DONE";

 $id= $_POST['studclass'];
 $dta=explode("$",$id);
$id=$dta[0];
$id1=$dta[1];
$id2 = $dta[2];
$sql3 = "SELECT roll_no, sem_id FROM results WHERE roll_no = $id1 and sem_id = $id and branch_id = $id2";
$result2 = mysqli_query($conn, $sql3);
$num = mysqli_num_rows($result2);
if($num > 0){
    ?>
    <p>
        <?php
        echo "<span style='color:red'> Result Already Declared.</span>";
        echo "<script>$('#submit').prop('disabled',true);</script>";
        ?>
    </p>
<?php
}
}
?>



