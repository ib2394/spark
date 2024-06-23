<<<<<<< Updated upstream
<?php
session_start();
include ('../../config/config.php');

// Check if the admin ID is stored in session
if (isset($_SESSION['adminid'])) {
    $session_adminid = $_SESSION['adminid'];

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        // Fetch POST data
        $adminid_post = $_POST['adminid'] ?? null;
        $admname = $_POST['admname'] ?? null;
        $admphone = $_POST['admphone'] ?? null;

        // Check if the adminid exists in the admin table
        $stmt_check_admin = $con->prepare("SELECT adminid FROM admin WHERE adminid = ?");
        $stmt_check_admin->bind_param("s", $adminid_post);
        $stmt_check_admin->execute();
        $result = $stmt_check_admin->get_result();

        if ($result->num_rows > 0) {
            // Update the admin table
            $stmt_admin = $con->prepare("UPDATE admin SET admname = ?, admphone = ? WHERE adminid = ?");
            $stmt_admin->bind_param("sss", $admname, $admphone, $adminid_post);
            $exec_admin = $stmt_admin->execute();
            $stmt_admin->close();

            if ($exec_admin === false) {
                die('Execute failed for admin update: ' . htmlspecialchars($con->error));
            }

            echo "<script type='text/javascript'>alert('Successfully updated');</script>";
        } else {
            echo "<script type='text/javascript'>alert('Invalid admin ID');</script>";
        }

        $stmt_check_admin->close();
    }
} else {
    echo "<script type='text/javascript'>alert('No admin ID found in session. Please login again.');</script>";
}
?>

=======
>>>>>>> Stashed changes
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< Updated upstream
    <title>Admin Update</title>
</head>
=======
    <title>List of Parcels</title>
    <style>
        /* General styles */
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
            width: 100%;
            max-width: 1200px;
            background-color: #fff;
            border-radius: 20px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-top: 20px;
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

        /* Search box styles */
        .search-box {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
        }

        .search-box input[type="text"] {
            width: 100%;
            max-width: 500px;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 20px;
            font-size: 16px;
            outline: none;
        }

        .search-box button {
            background: #333;
            color: white;
            border: none;
            padding: 15px 25px;
            cursor: pointer;
            border-radius: 20px;
            margin-left: 10px;
            font-size: 1rem;
            transition: background 0.3s ease;
        }

        .search-box button:hover {
            background: #222;
        }

        /* Print button styles */
        .print-button {
            text-align: center;
            margin-top: 20px;
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
        }

        .print-button button:hover {
            background: #222;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .container {
                border-radius: 0;
            }

            .search-box {
                flex-direction: column;
                align-items: stretch;
            }

            .search-box input[type="text"] {
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Back button -->
        <div class="submit-btn">
            <button type="submit" onclick="window.history.back();">BACK</button>
        </div>

        <!-- Header -->
        <div class="header">
            <h1>List of Parcels</h1>
        </div>

        <!-- Search Box -->
        <div class="search-box">
            <form method="POST">
                <input type="text" placeholder="Search parcels by Courier, Size, Status, or Pay ID" name="search">
                <button type="submit">Search</button>
            </form>
        </div>

        <!-- Parcel List -->
        <div class="parcel-list">
            <?php
            session_start();
            include("../../config/config.php");

            // Assuming the user is logged in and session is set, you can optionally check for it
            if (isset($_SESSION['studid'])) {
                $studid = $_SESSION['studid'];

                // Fetch the required parcel data from the database
                $query = "SELECT trackingNumber, courname, size, status, payStatus FROM parcel";
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

        <!-- Print Button -->
        <div class="print-button">
            <button onclick="window.print()">Print</button>
        </div>
    </div>
</body>
</html>
>>>>>>> Stashed changes
