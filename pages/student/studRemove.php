<?php
    session_start(); // Start the session
    include("../../config/config.php");
    $message = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        if (!isset($_SESSION['studid'])) {
            echo "<script type='text/javascript'>alert('Student Username is not set in the session');</script>";
            exit();
        }
        // Retrieve form data
        $dataId = $_POST['dataId'];

        // Validate the dataId
        if (!is_numeric($dataId)) {
            $message = "Invalid ID format.";
        } else {
            
                $table = 'student';

                // Prepare the SQL delete statement
                $sql = "DELETE FROM $table WHERE $dataId = ?";
                $stmt = $con->prepare($sql);
                
                // Check if the statement was prepared successfully
                if (!$stmt) {
                    $message = "Error preparing statement: " . $con->error;
                } else {
                    $stmt->bind_param("i", $dataId);

                    // Execute the statement and check for success
                    if ($stmt->execute()) {
                        /*$message = "Data has been removed successfully.";*/
                        //successful execution, no message needed
                    } else{
                       $message = "Error removing data: ". $con->error;
                    }

                    // Close the statement and connection
                    $stmt->close();
                }
            
        }

        $con->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SPARK SYSTEM: Student Removal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #BFACE2;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .logo {
            position: absolute;
            top: 20px;
            left: 20px;
        }
        .logo img {
            height: 125px; /* Adjust as needed */
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .container h2 {
            margin-bottom: 20px;
        }
        .container form {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 5px;
        }
        .container input[type="text"] {
            padding: 10px;
            margin: 10px 0;
            width: 100%;
            max-width: 300px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .container input[type="submit"] {
            padding: 10px 20px;
            border: none;
            background-color: #4CAF50;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }
        .container input[type="submit"]:hover {
            background-color: #45a049;
        }
        .note {
            font-size: 0.7em;
            color: #555;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="logo">
        <img src="img/spark(no bg).png" alt="SPARK Logo">
    </div>
    <div class="container">
        <h1>SPARK SYSTEM: Student Removal</h1>
        
        <form action="" method="POST">
            <input type="hidden" name="dataType" value="student">
            
            <input type="text" name="dataId" placeholder="Enter Your ID">
            <p class="note">Student can remove their data only!</p>
            <input type="submit" value="Remove">
        </form>
        
    </div>
</body>
</html>