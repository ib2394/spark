<?php
include("../../config/config.php");

// Start session after including config.php
session_start();

if (isset($_SESSION['adminid'])) {
    $adminid = $_SESSION['adminid'];

    $sql = "SELECT empid, empUsername, emppass, empname, empphone, jobtitle, ppEmp FROM employee";
    $result = mysqli_query($con, $sql);

    // Check if the query was successful
    if (!$result) {
        die("Error executing query: " . mysqli_error($con));
    }

    if (mysqli_num_rows($result) > 0) {
        echo "<h2>List of Employees</h2>";
        echo "<table border='1'>";
        echo "<tr><th>Username</th><th>Password</th><th>Employee Name</th><th>Phone</th><th>Job Title</th><th>Profile Picture</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            
            echo "<td>" . $row["empUsername"] . "</td>";
            echo "<td>" . $row["emppass"] . "</td>";
            echo "<td>" . $row["empname"] . "</td>";
            echo "<td>" . $row["empphone"] . "</td>";
            echo "<td>" . $row["jobtitle"] . "</td>";
            echo "<td><img src='" . $row["ppEmp"] . "' alt='Profile Picture' width='50' height='50'></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No employees found";
    }
}
mysqli_close($con);
?>
