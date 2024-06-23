<?php
include("../../config/config.php");

// Start session after including config.php
session_start();
if (isset($_SESSION['adminid'])) {
    $adminid = $_SESSION['adminid'];

// Establish database connection
$con = mysqli_connect("localhost", 'root', '', "spark_system");
if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}

$sql = "SELECT empUsername, emppass, empname, empphone, jobtitle, ppEmp FROM employee";
$result = mysqli_query($con, $sql);

// Check if the query was successful
if (!$result) {
    die("Error executing query: " . mysqli_error($con));
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Employees</title>
    <style>
        /* General Reset and Typography */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
            line-height: 1.6;
        }

        .container {
            max-width: 800px;
            margin: 2rem auto;
            background-color: #fff;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 2rem;
            color: #333;
            font-size: 2rem;
            font-weight: 500;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2rem;
            border-radius: 12px;
            overflow: hidden;
        }

        th, td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #333;
            color: #fff;
            font-weight: 500;
            font-size: 1rem;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        img {
            border-radius: 50%;
            width: 50px;
            height: 50px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>List of Employees</h2>
        <table>
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Employee Name</th>
                    <th>Phone</th>
                    <th>Job Title</th>
                    <th>Profile Picture</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["empUsername"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["emppass"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["empname"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["empphone"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["jobtitle"]) . "</td>";
                        echo "<td><img src='" . htmlspecialchars($row["ppEmp"]) . "' alt='Profile Picture'></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' style='text-align: center;'>No employees found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
mysqli_close($con);
}
?>
