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

    $trackingNumber = $_POST['trackingNumber'];
    $courname = $_POST['courier_name'];


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

    // Get current date and time
    $currentDate = date('Y-m-d');
    $currentTime = date('H:i:s'); 

     // Insert the data into the parcel table with the associated studid
     $stmt_insert_parcel = $con->prepare("INSERT INTO parcel (trackingNumber, courname, payid, studid, date, time) VALUES (?,?,?,?,?,?)");
     $stmt_insert_parcel->bind_param("ssssss", $trackingNumber, $courname, $payid, $studid, $currentDate, $currentTime);
     $stmt_insert_parcel->execute();
     $stmt_insert_parcel->close();

    echo "<script type='text/javascript'>alert('Successfully inserted');</script>";
} else {
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
        <form action="studentinsert.php" method="post" class="form-grid">
            <div class="input-group">
                <input type="text" name="trackingNumber" required>
                <label for="trackingNumber">Tracking Number :</label>
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
            <div class="submit-btn">
                <button type="submit">ADD</button>
            </div>
        </form>
    </div>
</body>
</html>
