<!DOCTYPE html>
<html>
<head>
    <title>School Management System</title>
</head>
<body>
    <h2>Welcome to our School Management System</h2>
    <p>Choose what you would like to do:</p>
    <a href="index.php">Home</a> |
    <a href="addstudent.php">Add a student</a> |
    <a href="addparent.php">Add a parent</a> |
    <a href="seestudent.php">See all students</a> |
    <a href="seesparent.php">See all parents</a>
    <a href="deleteparent.php">Delete a parent</a>
    <a href="updateparent.php">Update a parent</a>

    <?php
    // Database connection details
    $link = mysqli_connect("localhost", "root", "password", "myschool");

    // Check connection
    if ($link === false) {
        die("Connection failed: " . mysqli_connect_error());
    }
    ?>
    <hr>


    <h3>See all parents</h3>
    <table border="1">
        <tr>
            <th width="150px">Parent ID<br><hr></th>
            <th width="250px">Parent Name<br><hr></th>
        </tr>
        <?php
        // Execute the query
        $sql = mysqli_query($link, "SELECT ParentID, ParentName FROM Parents");
        // Fetch the data and display in table
        while ($row = $sql->fetch_assoc()) {
            echo "
            <tr>
                <td>{$row['ParentID']}</td>
                <td>{$row['ParentName']}</td>
            </tr>";
        }
        ?>
    </table>
    <?php
    // Close the database connection
    $link->close();
    ?>

    <hr>

</body>

</html>
