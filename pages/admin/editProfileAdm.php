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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Update</title>
</head>