<?php
session_start();
include ('../../config/config.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $AdmUsername = $_POST['admUsername'];
    $admpass = $_POST['admpass'];

    // Basic validation
    if (!empty($AdmUsername) && !empty($admpass) && !is_numeric($AdmUsername)) {
        // Prepare the SQL statement to prevent SQL injection
        $stmt = $con->prepare("SELECT * FROM admin WHERE admUsername = ? LIMIT 1");
        $stmt->bind_param("s", $AdmUsername);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result) {
            if ($result->num_rows > 0) {
                $user_data = $result->fetch_assoc();

                // Verify the password
                if ($user_data['admpass'] == $admpass) {
                    // Set session variable for adminid
                    $_SESSION['admUsername'] = $user_data['admUsername'];

                    // Redirect to admin page
                    header("Location: adminpage.php");
                    die();
                }
            }
        }

        // Invalid login credentials
        echo "<script>alert('Oops! Wrong ID or Password')</script>";
    } else {
        // Invalid input
        echo "<script>alert('Oops! Wrong ID or Password')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../css/style1.css">
        <title>Login</title>
    </head>
    <body>
        <div class="page">
            <div class="box form-box">
                <header>Admin Login</header>
                <form action="../../pages/admin/loginAdm.php" method="POST">
                    
                    <div class="field input">
                        <label>Username </label>
                        <input type="text" name="admUsername" required>
                    </div>

                    <div class="field input">
                        <label>Password </label>
                        <input type="password" name="admpass" required>
                    </div>

                    <div class="field">
                        <input type="submit" class="btn"name="submit" value="Login" required>
                    </div>
                    <div class="links">
                        Don't have account? <a href="../../pages/admin/signupAdm.php">Sign Up</a>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>