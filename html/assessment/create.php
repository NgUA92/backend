<?php
$link = mysqli_connect("localhost", "root", "password", "myschool");

if ($link === false) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "CREATE TABLE students (
    StudentID INT AUTO_INCREMENT PRIMARY KEY,
    StudentName VARCHAR(100) NOT NULL,
    ParentID INT NOT NULL,
    FOREIGN KEY (ParentID) REFERENCES Parents(ParentID)
)";

if (mysqli_query($link, $sql)) {
    echo "Table students created successfully";
} else {
    echo "Error creating table: " . mysqli_error($link);
}

mysqli_close($link);
?>
