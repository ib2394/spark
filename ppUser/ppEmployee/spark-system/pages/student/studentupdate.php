<?php
session_start();
include ('../../config/config.php');

// Check if the student ID is stored in session
if (isset($_SESSION['studid'])) {
    $studid = $_SESSION['studid'];

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        // Fetch POST data with null coalescing to avoid undefined array key warnings
        $parcelid = $_POST['parcelid'] ?? null;
        $courname = $_POST['courier_name'] ?? null;
        $paymethod = $_POST['paymethod'] ?? null;
        $studphone = $_POST['studphone'] ?? null;
        $studaddress = $_POST['studaddress'] ?? null;

         // Determine the payid based on the paymethod
         if ($paymethod == 'Cash') {
            $payid = 'P001';
            // Update the payment table with the new paymethod
            $stmt_payment = $con->prepare("UPDATE payment SET paymethod = ? WHERE payid = ?");
            $stmt_payment->bind_param("ss", $paymethod, $payid);
            $exec_payment = $stmt_payment->execute();
            $stmt_payment->close();
            if ($exec_payment === false) {
                die('Execute failed for payment update: ' . htmlspecialchars($con->error));
            }
        } 
        elseif ($paymethod == 'QR') {
            $payid = 'P002';
             // Update the payment table with the new paymethod
             $stmt_payment = $con->prepare("UPDATE payment SET paymethod = ? WHERE payid = ?");
             $stmt_payment->bind_param("ss", $paymethod, $payid);
             $exec_payment = $stmt_payment->execute();
             $stmt_payment->close();
             if ($exec_payment === false) {
                die('Execute failed for payment update: ' . htmlspecialchars($con->error));
            }
        } 
        else {
            echo "<script type='text/javascript'>alert('Invalid payment method');</script>";
            exit();
        }

       

        // Update the parcel table with the new payid
        $stmt_parcel = $con->prepare("UPDATE parcel SET courname = ?, payid = ? WHERE parcelid = ? AND studid = ?");
        $stmt_parcel->bind_param("ssss", $courname, $payid, $parcelid, $studid);
        $exec_parcel = $stmt_parcel->execute();
        $stmt_parcel->close();

        if ($exec_parcel === false) {
            die('Execute failed for parcel update: ' . htmlspecialchars($con->error));
        }

        // Update the student table with the new details
        $stmt_student = $con->prepare("UPDATE student SET studphone = ?, studaddress = ? WHERE studid = ?");
        $stmt_student->bind_param("sss", $studphone, $studaddress, $studid);
        $exec_student = $stmt_student->execute();
        $stmt_student->close();

        if ($exec_student === false) {
            die('Execute failed for student update: ' . htmlspecialchars($con->error));
        }

        echo "<script type='text/javascript'>alert('Successfully updated');</script>";
    }
} else {
    echo "<script type='text/javascript'>alert('No student ID found in session. Please login again.');</script>";
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Update</title>
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
        <h1>Student</h1>
        <div class="navbar">
            <img class="logo" src="../../pictures/logoParcel.png" alt="Logo">
            <ul>
            <li><a href="../../pages/student/studentinsert.php"><button type="button">ADD PARCEL</button></a></li>
                <button type="button">EDIT PARCEL</button>
                <button type="button">REMOVE</button>
                <button type="button">SEARCH</button>
                <button type="button">VIEWING</button>
                <img class="image" src="../../pictures/home.png" alt="Home">
            </ul>
        </div>
    </div>
    <div class="form-container">
        <form action="../../pages/student/studentupdate.php" method="post" class="form-grid">
            <div class="input-group">
                <input type="text" name="parcelid" required>
                <label for="parcelid">Parcel ID :</label>
            </div>
            <div class="input-group">
                <select name="courier_name" required>
                    <option value="" disabled selected>Select Courier Name</option>
                    <option value="JNT">JNT</option>
                    <option value="DHL">DHL</option>
                    <option value="NINJAVAN">NINJAVAN</option>
                    <option value="POSLAJU">POSLAJU</option>
                    <option value="SHOPEEEXPRESS">SHOPEEEXPRESS</option>
                </select>
                <label for="courier_name">Courier Name :</label>
            </div>
            <div class="input-group">
                <select name="paymethod" required>
                    <option value="" disabled selected>Select Payment Method</option>
                    <option value="CASH">CASH</option>
                    <option value="QR">QR</option>
                </select>
                <label for="paymethod">Payment Method :</label>
            </div>
            <div class="input-group">
                <input type="text" name="studphone" required>
                <label for="studphone">Phone Num :</label>
            </div>
            <div class="input-group">
                <input type="text" name="studaddress" required>
                <label for="studaddress">Address :</label>
            </div>
            <div class="submit-btn">
                <button type="submit">UPDATE</button>
            </div>
        </form>
    </div>
</body>
</html>

