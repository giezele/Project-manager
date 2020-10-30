<?php
require_once "dbConn.php"; 

if(isset($_POST['submit']))
{		
    $project_name = $_POST['project_name'];

    $insert = mysqli_query($conn,"INSERT INTO `projects`(`project_name`) VALUES ('$project_name')");

    if(!$insert)
    {
        echo mysqli_error($link);
    }
    else
    {
        echo "Records added successfully.";
    }
}

mysqli_close($conn); // Close connection
header("location:./?path=Projects"); // redirects to index page
exit;
?>