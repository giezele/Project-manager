<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sprint2</title>
    <link rel="stylesheet" type="text/css" href="./css/normalize.css">
    <link rel="stylesheet" type="text/css" href="./css/style.css">
</head>
<body>
<?php

require_once "dbConn.php"; // Using database connection file here

// $id = $_GET['id']; 

if (isset($_GET['project_id']) && intval($_GET['project_id'])) {
    $id = (int) $_GET['project_id'];
    

    $sql = "SELECT * FROM projects 
            WHERE project_id='$id'";

    $qry = mysqli_query($conn, $sql); // select query

    $row = mysqli_fetch_array($qry); // fetch data

    if(isset($_POST['update'])) // when click on Update button
    {
        $name = $_POST['name'];
        
        $edit = mysqli_query($conn,"UPDATE projects SET project_name='$name' WHERE project_id='$id'");

        
        if($edit)
        {
            mysqli_close($conn); // Close connection
            header("location:./?path=Projects"); // redirects to index page
            exit;
        }
        else
        {
            echo ("Error ". mysqli_error($link));
        }
    }
}
?>

<h3>Update Project Data</h3>

<form method="POST" class="formDiv">
    <label for="project_name">Update name:</label>
    <input type="text" name="name" id="project_name" value="<?php echo $row['project_name'] ?>" placeholder="Update Project Name" Required>
    <input type="submit" name="update" value="Update" class="nice_btn">
</form>

</body>
</html>