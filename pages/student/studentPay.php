<?php
session_start();
include '../../config/config.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Retrieve the logged-in studid from the session
    if (!isset($_SESSION['studUsername'])) {
        echo "<script type='text/javascript'>alert('Student Username is not set in the session');</script>";
        exit();
    }
    $studUsername = $_SESSION['studUsername'];

    $trackingNumber = $_SESSION['trackingNumber'];
    $courname = $_SESSION['courname'];
    $paymethod = $_POST['paymethod'];

    // Handle file upload for payment proof
    $proof = null;
    if (isset($_FILES['proof']['tmp_name']) && !empty($_FILES['proof']['tmp_name'])) {
        $proof = file_get_contents($_FILES['proof']['tmp_name']);
    }

    // Check if the studUsername exists in the student table
    $stmt_check_student = $con->prepare("SELECT studUsername FROM student WHERE studUsername =?");
    $stmt_check_student->bind_param("s", $studUsername);
    $stmt_check_student->execute();
    $result_student = $stmt_check_student->get_result();

    if ($result_student->num_rows == 0) {
        echo "<script type='text/javascript'>alert('Student Username does not exist');</script>";
        exit();
    }
    $stmt_check_student->close();

     // Check if the TRACKING NUMBER exists in the student table
     $stmt_check_parcel = $con->prepare("SELECT trackingNumber FROM parcel WHERE trackingNumber =?");
     $stmt_check_parcel->bind_param("s", $trackingNumber);
     $stmt_check_parcel->execute();
     $result_parcel = $stmt_check_parcel->get_result();
 
     if ($result_parcel->num_rows == 0) {
         echo "<script type='text/javascript'>alert('tracking number does not exist');</script>";
         exit();
     }
     $stmt_check_parcel->close();
 
     
    // Calculate price based on parcel size
    $size = $_POST['size']; 
        $price = 'RM 1';
    } elseif ($size == 'Medium') {
        $price = 'RM 2';
    } elseif ($size == 'Large') {
        $price = 'RM 3';
    } else {
        echo "<script type='text/javascript'>alert('Invalid size');</script>";
        exit();
    }

    // Insert the payment information
    $stmt_insert_payment = $con->prepare("INSERT INTO payment (paymethod, price) VALUES (?,?)");
    $stmt_insert_payment->bind_param("ss", $paymethod, $price);
    $stmt_insert_payment->execute();
    $payid = $stmt_insert_payment->insert_id;
    $stmt_insert_payment->close();

    // Get current date and time
    $currentDate = date('Y-m-d');
    $currentTime = date('H:i:s');

    // Insert the parcel information
    $stmt_insert_parcel = $con->prepare("INSERT INTO parcel (trackingNumber, courname, payid, studid, date, time) VALUES (?,?,?,?,?,?)");
    $stmt_insert_parcel->bind_param("ssssss", $trackingNumber, $courname, $payid, $studUsername, $currentDate, $currentTime);
    $stmt_insert_parcel->execute();
    $stmt_insert_parcel->close();

    echo "<script type='text/javascript'>alert('Successfully inserted');</script>";
 else {
    echo "<script type='text/javascript'>alert('Please enter some valid information');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Insert</title>
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

        .input-group input[type="text"], .input-group select, .input-group input[type="file"] {
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
        <h1>STUDENT</h1>
        <div class="navbar">
            <img class="logo" src="../../pictures/logoParcel.png" alt="Logo">
            <ul>
                <li><a href="studentinsert.php"><button type="button">ADD PARCEL</button></a></li>
                <li><a href="studentupdate.php"><button type="button">EDIT PARCEL</button></a></li>
                <button type="button">REMOVE</button>
                <button type="button">SEARCH</button>
                <button type="button">VIEWING</button>
                <img class="image" src="../../pictures/home.png" alt="Home">
            </ul>
        </div>
    </div>
    <div class="form-container">
        <form action="studentPay.php" method="post" class="form-grid">
            <div class="input-group">
                <input type="text" name="trackingNumber" required>
                <label for="trackingNumber">Tracking Number :</label>
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
                <input type="file" name="proof" required>
                <label for="proof">Payment Proof :</label>
            </div>
            <div class="submit-btn">
                <button type="submit">SUBMIT</button>
            </div>
        </form>
    </div>
</body>
</html>
