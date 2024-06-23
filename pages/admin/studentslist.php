<?php
session_start();
include("../../config/config.php");

if (isset($_SESSION['adminid'])) {
    $adminid = $_SESSION['adminid'];

    // Fetch all student data from the database
    $query = "SELECT studUsername, studname, studaddress, email, studphone, ppStud FROM student";
    $result = mysqli_query($con, $query);

    // Check if any rows were returned
    if (mysqli_num_rows($result) > 0) {
        // Output data of each row
        echo "<h2>List of Students</h2>";
        echo "<table border='1'>";
        echo "<tr><th>Username</th><th>Name</th><th>Address</th><th>Email</th><th>Phone</th><th>Profile Picture</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["studUsername"] . "</td>";
            echo "<td>" . $row["studname"] . "</td>";
            echo "<td>" . $row["studaddress"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["studphone"] . "</td>";
            echo "<td><img src='" . $row["ppStud"] . "' alt='Profile Picture' width='50' height='50'></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No students found.";
    }
}
?>
