<!DOCTYPE html>
<html>

<head>
    <title>Delete Parent Record</title>
</head>

<body>

    <h2>Delete a Parent Record</h2>

    <p>Choose what you would like to do:</p>
    <a href="index.php">Home</a> |
    <a href="addstudent.php">Add a student</a> |
    <a href="addparent.php">Add a parent</a> |
    <a href="seestudent.php">See all students</a> |
    <a href="seeparent.php">See all parents</a>
    <a href="deleteparent.php">Delete a parent</a>
    <a href="updateparent.php">Update a parent</a>
    <br><br>

    <h3>Select a Parent to Delete</h3>

    <form method="post" action="deleteparent.php">

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
        <input type="submit" name="submit" value="Delete Parent">
    </form>

    <?php
    // Form submission handling
     if (isset($_POST['submit'])) {
        $ParentID = $_POST['ParentID'];

        // First, delete associated student records
        $delete_students_sql = "DELETE FROM Students WHERE ParentID='$ParentID'";
        if ($link->query($delete_students_sql) === TRUE) {
            // Now, delete the parent record
            $delete_parent_sql = "DELETE FROM Parents WHERE ParentID='$ParentID'";
            if ($link->query($delete_parent_sql) === TRUE) {
                echo "Parent and associated student records deleted successfully.<br>";
            } else {
                echo "Error deleting parent record: " . $link->error . "<br>";
            }
        } else {
            echo "Error deleting associated student records: " . $link->error . "<br>";
        }
    }
    // Close the database connection
    $link->close();
    ?>

    <hr>

</body>

</html>
