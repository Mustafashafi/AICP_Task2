<?php
require_once('connection.php');

if(isset($_POST['delete_task'])){
    $Title = $_POST['Title'];

    // Check if the task with the given title exists
    $check_query = "SELECT * FROM all_tasks WHERE Title='$Title'";
    $result = mysqli_query($con, $check_query);

    if(mysqli_num_rows($result) > 0) {
        // Prepare the SQL statement to prevent SQL injection
        $stmt = $con->prepare("DELETE FROM all_tasks WHERE Title = ?");
        $stmt->bind_param("s", $Title);

        if($stmt->execute()){
            header('Location: Task2.php');
        } else {
            $_SESSION['message'] = '<div class="alert alert-danger alert-dismissible" style="position:fixed;top:50px;left:520px">
                Task deletion failed!
            </div>';
            header('Location: delete.php');
        }
    } else {
        $_SESSION['message'] = '<div class="alert alert-danger alert-dismissible" style="position:fixed;top:50px;left:520px">
            Task not found!
        </div>';
        header('Location: delete.php');
    }
}
?>
