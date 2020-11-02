<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once "dbConn.php"; 

if(isset($_POST['submit']))
{		
    $fullname = $_POST['fullname'];

    // $insert = mysqli_query($conn,"INSERT INTO `employees`(`name`) VALUES ('$fullname')"); //no prepared statement

    // prepare and bind
    $sql = "INSERT INTO `employees`(`name`) VALUES (?)";
    if($query = $conn->prepare($sql)) { 
        $query->bind_param('s', $fullname);
        $query->execute();
        
    } else {
        $error = $conn->errno . ' ' . $conn->error;
        echo $error; 
    }
}

mysqli_close($conn); // Close connection
header("location:./?path=Employees"); // redirects to index page
exit;
?>