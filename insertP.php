<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once "dbConn.php"; 

if(isset($_POST['submit']))
{		
    $project_name = $_POST['project_name'];

    // $insert = mysqli_query($conn,"INSERT INTO `projects`(`project_name`) VALUES ('$project_name')");

    // prepare and bind
    $sql = "INSERT INTO `projects`(`project_name`) VALUES (?)";
    if($query = $conn->prepare($sql)) { 
        $query->bind_param('s', $project_name);
        $query->execute();
        
    } else {
        $error = $conn->errno . ' ' . $conn->error;
        echo $error; 
    }
}

mysqli_close($conn); // Close connection
header("location:./?path=Projects"); // redirects to index page
exit;
?>