<?php

require_once "dbConn.php"; // Using database connection file here

// $id = $_GET['id']; // get id through query string
$id = isset($_POST['project_id'])?intval($_POST['project_id']):0;

if($id>0) { 
    $del = mysqli_query($conn,"DELETE FROM projects WHERE project_id = '$id' LIMIT 1"); // delete query
print_r($del);
    if($del) {
        mysqli_close($conn); // Close connection
        header("location:./?path=Projects"); // redirects to all records page
        exit;	
    } 
}
else
{
    echo "Error deleting record"; // display error message if not delete
}


 
?>