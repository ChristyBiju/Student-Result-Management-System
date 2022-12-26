<?php


include('includes/connection.php');
if(!empty($_POST["classid"])) 
{


 $cid=intval($_POST['classid']);
 if(!is_numeric($cid)){
 
 	echo htmlentities("Invalid Class");
    exit;
 }
 else{
    // $classid = intval($_POST['classid']);
    $sql1 = "SELECT student.Name, reg_id FROM `student` WHERE semester = '$cid' order by Name";
    $result = mysqli_query($conn, $sql1);
    ?>
    <option value="">Select Name</option>
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
        
        ?>
        <option value="<?php echo $row['reg_id']; ?>"><?php echo $row['Name'];?></option>
        <?php
    }
}

}
// Code for Subjects
if(!empty($_POST["classid1"])) 
{
    // echo "DONE";
 $cid1=intval($_POST['classid1']);
 if(!is_numeric($cid1)){
 
  echo htmlentities("Invalid Class");exit;
 }
 else{

    $sql2 = "SELECT * FROM subject_comb, subjects where subjects.subj_id = subject_comb.subj_id and subject_comb.sem_id = $cid1 order by subjects.subj_name";
    $result1 = mysqli_query($conn, $sql2);
    
    while($row = mysqli_fetch_assoc($result1)){
        
    ?>
    <p>
        <?php echo $row['subj_name'];?><input type="text" name = "marks[]" value="" required="" placeholder="Enter marks out of 100" autocomplete="off">
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
$sql3 = "SELECT roll_no, sem_id FROM results WHERE roll_no = $id1 and sem_id = $id";
$result2 = mysqli_query($conn, $sql3);
$num = mysqli_num_rows($result2);
if($num > 0){
    ?>
    <p>
        <?php
        echo "<span style='color:red'> Result Already Declare .</span>";
        echo "<script>$('#submit').prop('disabled',true);</script>";
        ?>
    </p>
<?php
}
}
?>



