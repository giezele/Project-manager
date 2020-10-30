<?php

require_once "dbConn.php"; // Using database connection file here

// $id = $_GET['id']; // get id through query string
$id = isset($_POST['id'])?intval($_POST['id']):0;

if($id>0) { 
    $del = mysqli_query($conn,"DELETE FROM employees WHERE id = '$id' LIMIT 1"); // delete query
print_r($del);
    if($del) {
        mysqli_close($conn); // Close connection
        header("location:./?path=Employees"); // redirects to all records page
        exit;	
    } 
}
else
{
    echo "Error deleting record"; // display error message if not delete
}


 
?>