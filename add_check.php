<?php
require_once('connection.php');

if(isset($_POST['add_task'])){
    $Title = $_POST['Title'];
    $Description = $_POST['Description'];

    // Check if a task with the same title already exists
    $check_query = "SELECT * FROM `all_tasks` WHERE `Title`='$Title'";
    $result = mysqli_query($con, $check_query);

    if(mysqli_num_rows($result) > 0) {
        $_SESSION['message'] = '<div class="alert alert-danger alert-dismissible" style="position:fixed;top:50px;left:420px">
            Task with the same title already exists!
        </div>';
        header('location:add.php');
    } else {
        $query = "INSERT INTO `all_tasks`(`Title`, `Description`) VALUES('$Title','$Description')";
        
        if(mysqli_query($con,$query)){
            header('location:Task2.php');
        } else {
            $_SESSION['message'] = '<div class="alert alert-danger alert-dismissible" style="position:fixed;top:50px;left:420px">
                Task Record Uploading Failed!
            </div>';
            header('location:add.php');
        }
    }
}
?>
