<?php
session_start();
$showAlert = false;
$showError = false;
include "includes/connection.php";
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/pg1.css">
    <title>Search Result</title>
</head>
<body>
<?php
    if($showAlert){
        echo '<script>alert("Record Added Successfully!")</script>';
    }
    if($showError){
        echo '<script>alert("Error! Try Again.")</script>';

    }
    ?>
    <div  class="main">
    <div class="in">
    <form action="result.php" method="post">
        <div class="in1">
            <label for="branch_id">
                Branch &nbsp;&nbsp;&nbsp;: &nbsp;
            </label>
            <select name="branch_id" id="branch_id" required>
                <option value="">Select Branch</option>
                <?php 
        $sql = "SELECT * from `branch`";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
        ?>
            <option value="<?php echo $row['branch_id']; ?>" style="font-size:17px"><?php echo $row['branch'];?></option>

        <?php } ?>
            </select>

        </div>
        <div class="in2">
            <label for="sem_id">
                Semester :  &nbsp;
            </label>
            <select name="sem_id" id="sem_id" required>
                <option value="">Select Semester</option>
                <?php 
        $sql = "SELECT * from `semester`";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
        ?>
            <option value="<?php echo $row['sem_id']; ?>" style="font-size:17px"><?php echo $row['semester'];?></option>

        <?php } ?>
            </select>
        </div>
        <div class="in3">
            <label for="">
                Enter Roll No : 
            </label>
            <input type="text" required name="stid">
        </div>
        <div class="in4">
            <button type="submit">Search</button>
        </div>
    </form>
    <div class="e">
        <a href="index.php">Back to Home</a>
    </div>
    </div>
    

    </div>
</body>
</html>