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

if (isset($_GET['id']) && intval($_GET['id'])) {
    $id = (int) $_GET['id'];
    

    $sql = "SELECT * FROM employees 
            WHERE id='$id'";


    $qry = mysqli_query($conn, $sql); // select query

    $row = mysqli_fetch_array($qry); // fetch data

    if(isset($_POST['update'])) // when click on Update button
    {
        $name = $_POST['name'];
        $projects = $_POST['project_id'];

        $edit = mysqli_query($conn,"UPDATE employees 
                                    SET name='$name', project_id='$projects' 
                                    WHERE id='$id'");

        
        if($edit)
        {
            mysqli_close($conn); // Close connection
            header("location:./?path=Employees"); // redirects to index page
            exit;
        }
        else
        {
            echo ("Error ". mysqli_error($link));
        }    	
    }
}
?>
 
<h3>Update Employee data</h3>
<form method="POST" class="formDiv">
    <div>
        <label for="name">Update name:</label>
        <input type="text" id="name" name="name" value="<?php echo $row['name'] ?>" Required>
    </div>
    <div>
        <label for="project_id">Choose the project:</label>
        <select id="project_id" name="project_id">
            <?php
            $sql = "SELECT projects.project_id, projects.project_name 
                FROM projects";

            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <option value="<?php echo $row['project_id']; ?>"><?php echo $row['project_name']; ?></option>
                    <?php 
                }
            } ?>
        </select>
    </div>    
    <input type="submit" name="update" value="Update" class="nice_btn">
</form>

</body>
</html>