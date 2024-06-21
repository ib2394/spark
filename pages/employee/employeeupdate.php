<?php
session_start();
include ('../../config/config.php');

// Check if the employee ID is stored in session
if (isset($_SESSION['empUsername'])) {
    $empUsername = $_SESSION['empUsername'];

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        // Fetch POST data with null coalescing to avoid undefined array key warnings
        $trackingNumber = $_POST['trackingNumber'] ?? null;
        $size = $_POST['size'] ?? null;
        $status = $_POST['status'] ?? null;
        $payStatus = $_POST['payStatus'] ?? null;

        // Calculate price based on size
        switch ($size) {
            case 'small':
                $price = 1;
                break;
            case 'medium':
                $price = 2;
                break;
            case 'large':
                $price = 3;
                break;
            default:
                $price = 0; // Default or error handling if necessary
                break;
        }

        // Check if the tracking number exists in the parcel table
        $stmt_check_parcel = $con->prepare("SELECT trackingNumber FROM parcel WHERE trackingNumber = ?");
        $stmt_check_parcel->bind_param("s", $trackingNumber);
        $stmt_check_parcel->execute();
        $result = $stmt_check_parcel->get_result();

        if ($result->num_rows > 0) {
            // Update the parcel table
            $stmt_parcel = $con->prepare("UPDATE parcel SET size = ?, status = ?, payStatus = ?, empid = ?, price = ? WHERE trackingNumber = ?");
            $stmt_parcel->bind_param("ssssss", $size, $status, $payStatus, $empid, $price, $trackingNumber);
            $exec_parcel = $stmt_parcel->execute();
            $stmt_parcel->close();

            if ($exec_parcel === false) {
                die('Execute failed for parcel update: ' . htmlspecialchars($con->error));
            }

            echo "<script type='text/javascript'>alert('Successfully updated');</script>";
        } else {
            echo "<script type='text/javascript'>alert('Invalid tracking number');</script>";
        }

        $stmt_check_parcel->close();
    }
} else {
    echo "<script type='text/javascript'>alert('No employee Username found in session. Please login again.');</script>";
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Update</title>
    <style>
        /* Basic reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #BFACE2;
            color: #333;
            line-height: 1.6;
        }

        /* Banner styling */
        .banner {
            background: #645CBB;
            color: white;
            padding: 1rem 2rem;
            text-align: center;
            margin-bottom: 1rem;
        }

        .banner h1 {
            margin-bottom: 0.5rem;
            font-size: 2rem;
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
            gap: 1rem;
            align-items: center;
        }

        .navbar ul button {
            background: #645CBB;
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            cursor: pointer;
            border-radius: 20px;
            font-size: 1rem;
        }

        .navbar ul button:hover {
            background: #524a99;
        }

        .navbar ul img.image {
            height: 30px;
            cursor: pointer;
        }

        /* Form styling */
        .form-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            margin: 0 auto;
            max-width: 600px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .input-group {
            position: relative;
            margin-bottom: 1rem;
        }

        .input-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-size: 1rem;
            color: #333;
        }

        .input-group input[type="text"],
        .input-group select {
            width: 100%;
            padding: 0.75rem;
            font-size: 1rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #f9f9f9;
            transition: border-color 0.3s ease;
        }

        .input-group input[type="text"]:focus,
        .input-group select:focus {
            outline: none;
            border-color: #645CBB;
        }

        .submit-btn {
            text-align: center;
            margin-top: 1rem;
        }

        .submit-btn button {
            background: #645CBB;
            color: white;
            border: none;
            padding: 0.75rem 2rem;
            cursor: pointer;
            border-radius: 20px;
            font-size: 1rem;
            transition: background 0.3s ease;
        }

        .submit-btn button:hover {
            background: #524a99;
        }
    </style>
</head>
<body>
    <div class="banner">
        <h1>Employee</h1>
        <div class="navbar">
            <img class="logo" src="../../pictures/logoParcel.png" alt="Logo">
            <ul>
                <li><a href="employeeupdate.php"><button type="button">UPDATE</button></a></li>
                <li><button type="button">REMOVE</button></li>
                <li><button type="button">VIEWING</button></li>
                <li><img class="image" src="../../pictures/home.png" alt="Home"></li>
            </ul>
        </div>
    </div>
    <div class="form-container">
        <form action="../../pages/employee/employeeupdate.php" method="post" class="form-grid">
            <div class="input-group">
                <label for="trackingNumber">Tracking Number :</label>
                <input type="text" id="trackingNumber" name="trackingNumber" required>
            </div>
            <div class="input-group">
                <label for="size">Parcel Size :</label>
                <select id="size" name="size" required>
                    <option value="" disabled selected>Select Parcel Size</option>
                    <option value="large">Large</option>
                    <option value="medium">Medium</option>
                    <option value="small">Small</option>
                </select>
            </div>
            <div class="input-group">
                <label for="status">Parcel Status :</label>
                <select id="status" name="status" required>
                    <option value="" disabled selected>Select Parcel Status</option>
                    <option value="waiting">Waiting</option>
                    <option value="pickup">Pickup</option>
                    <option value="delivered">Delivered</option>
                </select>
            </div>
            <div class="input-group">
                <label for="payStatus">Payment Status :</label>
                <select id="payStatus" name="payStatus" required>
                    <option value="" disabled selected>Select Payment Status</option>
                    <option value="paid">PAID</option>
                    <option value="unpaid">UNPAID</option>
                </select>
            </div>
            <div class="submit-btn">
                <button type="submit">UPDATE</button>
            </div>
        </form>
    </div>
</body>
</html>
