<?php
include("../../config/config.php");

// Start session after including config.php
session_start();

// Establish database connection
$con = mysqli_connect("localhost", 'root', '', "spark_system");
if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}

$sql = "SELECT * FROM employee";
$result = mysqli_query($con, $sql);

// Check if the query was successful
if (!$result) {
    die("Error executing query: " . mysqli_error($con));
}

if (mysqli_num_rows($result) > 0) {
    echo "<h2>List of Employees</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Employee ID</th><th>Employee Name</th><th>Phone</th><th>Job Title</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>" . $row["empid"] . "</td><td>" . $row["empname"] . "</td><td>" . $row["empphone"] . "</td><td>" . $row["jobtitle"] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "No employees found";
}

mysqli_close($con);
?>
