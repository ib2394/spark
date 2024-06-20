<?php
session_start();

// Check if the user has submitted the logout form
if (isset($_POST['confirm_logout'])) {
  // Destroy the session.
  session_destroy();

  // Redirect to the login page (or any other page).
  header("Location: ../../pages/other/mainPage.php");
  exit();
}

// Display a confirmation message and a form to confirm logout
?>
<html>
  <head>
    <title>Logout</title>
  </head>
  <body>
    <h1>Logout</h1>
    <p>Are you sure you want to logout?</p>
    <form method="post">
      <input type="submit" name="confirm_logout" value="Yes, logout">
      <input type="button" value="No, cancel" onclick="history.go(-1)">
    </form>
  </body>
</html>