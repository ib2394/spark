<?php
    session_start();
    include("../../config/config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Parcels</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            width: 90%;
            max-width: 1200px;
            background-color: #fff;
            border-radius: 20px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            padding: 20px;
        }
        .header {
            background-color: #111;
            color: #fff;
            padding: 20px;
            text-align: center;
            border-radius: 20px 20px 0 0;
            font-size: 24px;
        }
        .header h1 {
            margin: 0;
            font-weight: 600;
        }
        .parcel-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            padding: 20px;
        }
        .parcel-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            overflow: hidden;
            cursor: pointer;
        }
        .parcel-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.2);
        }
        .parcel-card-content {
            padding: 20px;
        }
        .parcel-card-content h3 {
            margin-top: 0;
            font-size: 18px;
            color: #333;
            margin-bottom: 10px;
        }
        .parcel-details {
            color: #666;
            font-size: 14px;
        }
        .parcel-details p {
            margin: 5px 0;
        }
        .parcel-details strong {
            color: #111;
            font-weight: 600;
        }
        /* Print & back button CSS */
        .print-button {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            padding: 15px;
        }

        .print-button button {
            background: #333;
            color: white;
            border: none;
            padding: 15px 25px;
            cursor: pointer;
            border-radius: 20px;
            font-size: 1rem;
            transition: background 0.3s ease;
            margin-left: 10px;
        }

        .print-button button:hover {
            background: #222;
        }
        /* search CSS*/
        .box {
            width: 80%; /* Adjusted to take full width inside container */
            height: 20px;
            display: flex;
            cursor: pointer;
            padding: 15px;
            background: #fff;
            border-radius: 20px;
            border: transparent;
            align-items: center;
            margin-left: 100px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            position: center;
            margin-top: 30px;
            margin-bottom: 10px; /* Added margin for spacing */
        }
        .container box{
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 1rem 2rem;
            }
    </style>
</head>
<body>
    <div class="container">
        <!-- Print & Back Button -->
        <div class="print-button">
            <button type="submit" onclick="window.history.back();">Back</button>
            <button onclick="window.print()">Print</button>
        </div>

        <!-- Header -->
        <div class="header">
            <h1>List of Parcels</h1>
        </div>

        <!-- Search Box -->
        <form method="POST">
            <input class="box" type="text" placeholder="Search Here..." name="search">
        </form>

        <!-- Parcel List -->
        <div class="parcel-list">
            <?php
            // Assuming the user is logged in and session is set, you can optionally check for it
            if (isset($_SESSION['studid'])) {
                $studid = $_SESSION['studid'];

                // Fetch the required parcel data from the database
                if (isset($_POST['search'])) {
                    $search = $_POST['search'];
                    $query = "SELECT trackingNumber, courname, size, status, payStatus FROM parcel WHERE courname LIKE '%$search%' OR size LIKE '%$search%' OR status LIKE '%$search%' OR payStatus LIKE '%$search%'";
                } else {
                    $query = "SELECT trackingNumber, courname, size, status, payStatus FROM parcel";
                }

                $result = mysqli_query($con, $query);

                // Check if any rows were returned
                if (mysqli_num_rows($result) > 0) {
                    // Output data of each row
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="parcel-card">';
                        echo '<div class="parcel-card-content">';
                        echo '<h3>Tracking Number: ' . htmlspecialchars($row["trackingNumber"]) . '</h3>';
                        echo '<div class="parcel-details">';
                        echo '<p><strong>Courier Name:</strong> ' . htmlspecialchars($row["courname"]) . '</p>';
                        echo '<p><strong>Size:</strong> ' . htmlspecialchars($row["size"]) . '</p>';
                        echo '<p><strong>Status:</strong> ' . htmlspecialchars($row["status"]) . '</p>';
                        echo '<p><strong>Payment Status:</strong> ' . htmlspecialchars($row["payStatus"]) . '</p>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<p style="text-align: center; margin-top: 20px;">No parcels found.</p>';
                }
            }
            ?>
        </div>
    </div>
</body>
</html>
