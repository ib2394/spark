<?php
session_start();
include ('../../config/config.php');

// Check if the employee ID is stored in session
if (isset($_SESSION['empid'])) {
    $empid = $_SESSION['empid'];

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        // Fetch POST data with null coalescing to avoid undefined array key warnings
        $parcelid = $_POST['parcelid'] ?? null;
        $size = $_POST['size'] ?? null;
        $status = $_POST['status'] ?? null;

        // Check if the parcelid exists in the parcel table
        $stmt_check_parcel = $con->prepare("SELECT parcelid FROM parcel WHERE parcelid = ?");
        $stmt_check_parcel->bind_param("s", $parcelid);
        $stmt_check_parcel->execute();
        $result = $stmt_check_parcel->get_result();

        if ($result->num_rows > 0) {
            // Update the parcel table
            $stmt_parcel = $con->prepare("UPDATE parcel SET size = ?, status = ?, empid = ? WHERE parcelid = ?");
            $stmt_parcel->bind_param("ssss", $size, $status, $empid, $parcelid);
            $exec_parcel = $stmt_parcel->execute();
            $stmt_parcel->close();

            if ($exec_parcel === false) {
                die('Execute failed for parcel update: ' . htmlspecialchars($con->error));
            }

            echo "<script type='text/javascript'>alert('Successfully updated');</script>";
        } else {
            echo "<script type='text/javascript'>alert('Invalid parcel ID');</script>";
        }

        $stmt_check_parcel->close();
    }
} else {
    echo "<script type='text/javascript'>alert('No employee ID found in session. Please login again.');</script>";
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style2.css">
    <title>Employee Update</title>
    <style>
        /* Basic reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'poppins', sans-serif;
        }

        body {
            font-family: 'poppins', sans-serif;
            background-color: #BFACE2;
            color: #333;
        }

        /* Banner styling */
        .banner {
            background: #BFACE2;
            color: black;
            padding: 1rem 2rem;
            text-align: center;
        }

        .banner h1 {
            margin-bottom: 0.5rem;
        }

        .image {
            width: 30px;
            display: flex;
            align-items: center;
            cursor: pointer;
            margin: 20px 10px;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            background: #BFACE2;
        }

        .navbar img.logo {
            width: 120px;
            cursor: pointer;
        }

        .navbar ul {
            list-style: none;
            display: flex;
            gap: 3rem;
        }

        .navbar ul button {
            width: 200px;
            background: #645CBB;
            color: black;
            border: none;
            text-align: center;
            padding: 0.5rem 2rem;
            margin: 20px 10px;
            cursor: pointer;
            border-radius: 20px;
            font-size: 1rem;
            position: relative;
        }

        .navbar ul button:hover {
            background: #645CBB;
        }

        .navbar ul img.image {
            height: 30px;
            cursor: pointer;
        }

        /* Form styling */
        .form-container {
            display: flex;
            justify-content: center;
            padding: 2rem;
            background-color: #BFACE2;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem 2rem;
            align-items: center;
        }

        .input-group {
            position: relative;
            display: flex;
            flex-direction: column;
        }

        .input-group input[type="text"], .input-group select {
            padding: 0.75rem;
            border: 2px solid #333;
            border-radius: 4px;
            font-size: 1rem;
            background-color: #e0d4f7;
            width: 100%; /* Ensure it matches the width of the container */
        }

        /* Remove unnecessary padding and margin for select elements */
        .input-group select {
            padding: 0.75rem; /* Match the input padding */
            margin: 0; /* Remove extra margin */
        }

        .input-group label {
            margin-bottom: 0.5rem;
            font-size: 1rem;
            color: #333;
        }

        .submit-btn {
            grid-column: span 2;
            display: flex;
            justify-content: center;
            margin-top: 1rem;
        }

        .submit-btn button {
            background: #645CBB;
            color: black;
            border: none;
            padding: 0.75rem 1.5rem;
            cursor: pointer;
            border-radius: 20px;
            font-size: 1rem;
        }

        .submit-btn button:hover {
            background: #645CBB;
        }

        button {
            width: 200px;
            padding: 15px;
            margin: 20px 5px;
            text-align: center;
            border-radius: 25px;
            color: black;
            border: 2px;
            font-size: 20px;
            cursor: pointer;
            font-weight: 600;
        }

        button:hover {
            background-color: #645CBB;
            transition: 0.3s;
        }

        button:hover {
            color: white;
        }
    </style>
</head>
<body>
    <div class="banner">
        <h1>Employee</h1>
        <div class="navbar">
            <img class="logo" src="../../pictures/logoParcel.png" alt="Logo">
            <ul>
                <button type="button">UPDATE</button>
                <button type="button">REMOVE</button>
                <button type="button">SEARCH</button>
                <button type="button">VIEWING</button>
                <img class="image" src="../../pictures/home.png" alt="Home">
            </ul>
        </div>
        <div class="form-container">
            <form action="../../pages/employee/employeeupdate.php" method="post" class="form-grid">
                <div class="input-group">
                    <input type="text" name="parcelid" required>
                    <label for="parcelid">Parcel ID :</label>
                </div>
                <div class="input-group">
                    <select name="size" required>
                        <option value="" disabled selected>Select Parcel Size</option>
                        <option value="large">Large</option>
                        <option value="medium">Medium</option>
                        <option value="small">Small</option>
                    </select>
                    <label for="size">Parcel Size :</label>
                </div>
                <div class="input-group">
                    <select name="status" required>
                        <option value="" disabled selected>Select Parcel Status</option>
                        <option value="waiting">Waiting</option>
                        <option value="pickup">Pickup</option>
                        <option value="delivered">Delivered</option>
                    </select>
                    <label for="status">Parcel Status :</label>
                </div>
                <div class="submit-btn">
                    <button type="submit">UPDATE</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
