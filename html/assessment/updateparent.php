<!DOCTYPE html>
<html>

<head>
    <title>Update Parent Record</title>
</head>

<body>

    <h2>Update a Parent Record</h2>

    <p>Choose what you would like to do:</p>
    <a href="index.php">Home</a> |
    <a href="addstudent.php">Add a student</a> |
    <a href="addparent.php">Add a parent</a> |
    <a href="seestudent.php">See all students</a> |
    <a href="seeparent.php">See all parents</a> |
    <a href="deleteparent.php">Delete a parent</a> |
    <a href="updateparent.php">Update a parent</a>
    <br><br>

    <h3>Select a Parent to Update</h3>

    <form method="post" action="updateparent.php">

        <label>Select Parent:</label>
        <select name="ParentID">
            <?php
            // Database connection details
            $servername = "localhost";
            $username = "root";
            $password = "password";
            $dbname = "myschool";

            // Create connection
            $link = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($link->connect_error) {
                die("Connection failed: " . $link->connect_error);
            }

            // Fetch parents from the database
            $sql = $link->query("SELECT ParentID, ParentName FROM Parents");
            while ($row = $sql->fetch_assoc()) {
                echo "<option value='{$row['ParentID']}'>{$row['ParentName']}</option>";
            }
            ?>
        </select>
        <br><br>

        <label>New Parent Name:</label>
        <input type="text" name="NewParentName">
        <br><br>
        <input type="submit" name="submit" value="Update Parent">
    </form>

    <?php
    // Form submission handling
    if (isset($_POST['submit'])) {
        $ParentID = $_POST['ParentID'];
        $NewParentName = $_POST['NewParentName'];

        // SQL Update Query to update the selected parent's name
        $sql = "UPDATE Parents SET ParentName='$NewParentName' WHERE ParentID='$ParentID'";

        if ($link->query($sql) === TRUE) {
            echo "Record updated successfully.<br>";
        } else {
            echo "Error updating record: " . $link->error . "<br>";
        }
    }

    // Close the database connection
    $link->close();
    ?>

    <hr>

</body>

</html>
