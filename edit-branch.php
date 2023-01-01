<?php
session_start();
$showAlert = false;
$showError = false;
include "includes/connection.php";
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: index.php");
    exit;
}
$bid = intval($_GET['bid']);

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $branch = $_POST['branch'];
        $addsql = "UPDATE `branch` set branch.branch = '$branch' where branch_id = '$bid' ";
        $result = mysqli_query($conn, $addsql);
        if($result){
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
 <!-- <link rel="stylesheet" href="css/form.css">  -->

    <title>Add Branch</title>
</head>
<body style="background-color : alicewhite; margin : 0">
<?php include "nav.php"; ?>
<?php
    if($showAlert){
        echo '<script>alert("Branch Updated Successfully!")</script>';
    }
    if($showError){
        echo '<script>alert("Error! Try Again.")</script>';

    }
    ?>
    <div style="width : 67%; margin : auto auto; height : 400px; border : 2px solid rgb(200, 200, 200); margin-top : 80px;background-color: rgb(236, 236, 236)">
      <form method="post" >

      <h2 style="text-align:center; font-size : 30px">Add Branch</h2>
<div style=" width : 75%; margin:60px auto; font-size : 20px">

<?php
$sql = "SELECT branch.branch_id , branch.branch from branch where branch.branch_id = $bid";
$result = mysqli_query($conn, $sql);

$num = mysqli_num_rows($result);
if($num > 0){
    while($row = mysqli_fetch_assoc($result)){
        ?>
<p>
        <label for="branch">Branch  &nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;  
    <input name="branch" value="<?php echo $row['branch']; ?>" style="width : 50%;padding : 5px;font-size:17px"/>
</label>
      </p>


<?php
    }
}
?>
</div>
       
 


 
 
       
 <div style="float:right; margin-right : 80px">
        <button type="submit" style="width : 80px; padding : 7px;font-size : 17px; background-color : rgba(42, 42, 120, 0.909);color:white;">Update</button>

</div>

  </form>

    </div>

</body>
</html>