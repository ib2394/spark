<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Students</title>
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
        .students-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            padding: 20px;
        }
        .student-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            overflow: hidden;
            cursor: pointer;
        }
        .student-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.2);
        }
        .student-card-content {
            padding: 20px;
        }
        .student-card-content h3 {
            margin-top: 0;
            font-size: 18px;
            color: #333;
            margin-bottom: 10px;
        }
        .student-details {
            color: #666;
            font-size: 14px;
        }
        .student-details p {
            margin: 5px 0;
        }
        .student-details strong {
            color: #111;
            font-weight: 600;
        }
        @media (max-width: 768px) {
            .container {
                border-radius: 0;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>List of Students</h1>
        </div>
        <div class="students-list">
            <?php
            session_start();
            include("../../config/config.php");

            // Assuming the user is logged in and session is set, you can optionally check for it
            if (isset($_SESSION['empid'])) {
                $empid = $_SESSION['empid'];

                // Fetch all student data from the database
                $query = "SELECT studid, studUsername, studname, studaddress, email, studphone, ppStud FROM student";
                $result = mysqli_query($con, $query);

                // Check if any rows were returned
                if (mysqli_num_rows($result) > 0) {
                    // Output data of each row
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="student-card">';
                        echo '<div class="student-card-content">';
                        echo '<h3>' . htmlspecialchars($row["studname"]) . '</h3>';
                        echo '<div class="student-details">';
                        echo '<p><strong>Username:</strong> ' . htmlspecialchars($row["studUsername"]) . '</p>';
                        echo '<p><strong>Address:</strong> ' . htmlspecialchars($row["studaddress"]) . '</p>';
                        echo '<p><strong>Email:</strong> ' . htmlspecialchars($row["email"]) . '</p>';
                        echo '<p><strong>Phone:</strong> ' . htmlspecialchars($row["studphone"]) . '</p>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<p style="text-align: center; margin-top: 20px;">No students found.</p>';
                }
            }
            ?>
        </div>
    </div>
</body>
</html>
