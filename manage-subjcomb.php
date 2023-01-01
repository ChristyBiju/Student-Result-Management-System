<?php
session_start();
$showAlert = false;
$showError = false;
include "includes/connection.php";
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: index.php");
    exit;
}
if(isset($_GET['acid']))
{
$acid=intval($_GET['acid']);
$status=1;
$sql = "UPDATE subject_comb set status = $status where comb_id = $acid";
$result = mysqli_query($conn, $sql);
$showAlert = true;
}

if(isset($_GET['did']))
{
$did=intval($_GET['did']);
$status=0;
$sql = "UPDATE subject_comb set status = $status where comb_id = $did";
$result = mysqli_query($conn, $sql);
$showAlert = true;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Subject Combinations</title>
    <link rel="stylesheet" type="text/css" href="css/fp1.css?version=51">
    <!-- <link rel="stylesheet" href="css/fp1.css?parameter=1" type="text/css" /> -->
     
    	<!-- Datatable plugin CSS file -->
	<link rel="stylesheet" href=
"https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" />

	<!-- jQuery library file -->
	<script type="text/javascript"
	src="https://code.jquery.com/jquery-3.5.1.js">
	</script>

	<!-- Datatable plugin JS library file -->
	<script type="text/javascript" src=
"https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js">
	</script>


</head>
<body>
    <?php include "nav.php";?>
    <?php
    if($showAlert){
        echo '<script>alert("Subject Activated successfully!")</script>';
    }
    if($showError){
        echo '<script>alert("Subject Deactivated successfully!")</script>';

    }
    
    ?>
    <div class="m2">
        <h1 style="text-align:center;">Manage Subject Combinations</h1>
        <h3 style="margin : 20px; margin-bottom:50px">* View Subject Combinations</h3>
        <table id="tableID" class="display">
            <thead  >
                <tr >
                    <th >#</th>
                    <th>Branch</th>
                    <th>Semester</th>
                    <th>Subject</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead> 
            <tfoot>
                <tr>
                    <th >#</th>
                    <th>Branch</th>
                    <th>Semester</th>
                    <th>Subject</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </tfoot>
            <tbody>
<?php
$sql = "SELECT branch.branch, semester.semester, subjects.subj_name, subject_comb.comb_id as scid, subject_comb.status from subject_comb join branch on subject_comb.branch_id = branch.branch_id join semester on subject_comb.sem_id = semester.sem_id join subjects on subjects.subj_id = subject_comb.subj_id order by semester";
$result = mysqli_query($conn, $sql);
$c = 1;
$num = mysqli_num_rows($result);
if($num > 0){
    while($row = mysqli_fetch_assoc($result)){
        ?>
        <tr>
            <td><?php echo $c;?></td>
            <td><?php echo $row['branch'];?></td>
            <td><?php echo $row['semester'];?></td>
            <td><?php echo $row['subj_name'];?></td>
            <td><?php if($row['status'] == 1){
                echo "Active";
            }
            else{
                echo "Blocked";
            };?></td>
<td>
<?php if($row['status']=='0')
{ ?>
<a href="manage-subjcomb.php?acid=<?php echo $row['scid'];?>" onclick="confirm('Do you really want to ativate this subject');"><i class="fa fa-check" title="Acticvate Record"></i> </a><?php } else {?>

<a href="manage-subjcomb.php?did=<?php echo $row['scid'];?>" onclick="confirm('Do you really want to deativate this subject');"><i class="fa fa-times" title="Deactivate Record"></i> </a>
<?php }?>
</td>        
</tr>
        <?php
        $c++;
    }
}
?>
            </tbody>
        </table>
        <script>

		/* Initialization of datatable */
		$(document).ready(function() {
			$('#tableID').DataTable({ });
		});
	</script>
    </div>
</body>
</html>