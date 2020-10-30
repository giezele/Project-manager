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

?>
    <table class="redTable">
        <caption>
            <div class="wrap_cap">
                <div class="links"><a href="./?path=Employees">Employees </a>
                        <a href="./?path=Projects">Projects </a>
                </div>
                <div>PROJECT MANAGER</div>
            </div>
        </caption>

<?php
$path = $_GET['path'];
    //directing to employees table
if($path == 'Employees'){

    $sql = "SELECT id, name, project_name FROM employees
            LEFT JOIN projects ON employees.project_id = projects.project_id
            ORDER BY id";
    
    $result = mysqli_query($conn, $sql);

    // printing employees table
    if(mysqli_num_rows($result) > 0) {
    ?>
        <thead><tr>
            <th>ID</th>
            <th>Name</th>
            <th>Current Project</th>
            <th>Actions</th></tr>
        </thead>
        <tbody><tr>

    <?php
        while($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['project_name']; ?></td>
                <td>
                    <!-- //printing Delete and Edit buttons -->
                    <div class="btn_wrap">
                    <form action='deleteE.php?name="<?php echo $row['id']; ?>"' method="POST">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <input type="submit" name="submit" value="Delete">
                    </form>
                    <form action='editE.php?name="<?php echo $row['id']; ?>"' method="get">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <input type="submit" name="submit" value="Edit">
                    </form>
                    </div>
                </td>
     <?php
        }
        echo ('</tbody></table>');
    } else{
        echo "0 results";
    }
    ?>
        <!-- insert Employee form -->
        <form action="insertE.php" method="POST" class="formDiv">
        <label for="fullname">Add new Employee : </label>
        <input type="text" name="fullname" id="fullname" placeholder="Enter Employee Name" Required>
        <input type="submit" name="submit" value="Submit" class="nice_btn">
        </form>

    <?php
    //directing to Projects table
} else if($path == 'Projects') {

    $sql = "SELECT group_concat(employees.name SEPARATOR '; ') AS 'Employees on project', projects.project_id, projects.project_name 
            FROM projects 
            LEFT JOIN employees ON employees.project_id = projects.project_id
            GROUP BY project_id, project_name";
    
    $result = mysqli_query($conn, $sql);

    // printing projects table
    if (mysqli_num_rows($result) > 0) {
        ?>
         <thead><tr>
            <th>Project ID</th>
            <th>Project name</th>
            <th>Employees on project</th>
            <th>Actions</th></tr>
        </thead>
        <tbody><tr>

    <?php
        while($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
            <td><?php echo $row['project_id']; ?></td>
            <td><?php echo $row['project_name']; ?></td>
            <td><?php echo $row['Employees on project']; ?></td>
            <td>
                <div class="btn_wrap">
                    <!-- printing Delete and Edit buttons -->
                    <form action='deleteP.php?name="<?php echo $row['id']; ?>"' method="POST">
                        <input type="hidden" name="project_id" value="<?php echo $row['project_id']; ?>">
                        <input type="submit" name="submit" value="Delete">
                    </form>
                    <form action='editP.php?name="<?php echo $row['id']; ?>"' method="GET">
                        <input type="hidden" name="project_id" value="<?php echo $row['project_id']; ?>">
                        <input type="submit" name="submit" value="Edit">
                    </form>
                </div>
            </td>
        <?php
        }
        echo ('</tbody></table>');
        ?>
        <!-- insert Project form -->
        <form action="insertP.php" method="POST" class="formDiv">
        <label for="project_name">Add new Project : </label>
        <input type="text" name="project_name" id="project_name" placeholder="Enter Project Name" Required>
        <input type="submit" name="submit" value="Submit" class="nice_btn">
        </form>
        <?php
    } else {
        echo "0 results";
    }
} else {
    echo("Choose Employees or Projects");
}

mysqli_close($conn);

?>

</body>
</html>