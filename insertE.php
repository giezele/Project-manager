<?php
require_once "dbConn.php"; 

if(isset($_POST['submit']))
{		
    $fullname = $_POST['fullname'];

    $insert = mysqli_query($conn,"INSERT INTO `employees`(`name`) VALUES ('$fullname')");

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
header("location:./?path=Employees"); // redirects to index page
exit;
?>