<?php
    session_start();

    include ('../../config/config.php');

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $studUsername = $_POST['studUsername'];
        $studpass = $_POST['studpass'];

        if(!empty($studUsername) && !empty($studpass) && !is_numeric($studUsername)){
            $query="select * from student where studUsername='$studUsername' limit 1";
            $result=mysqli_query($con, $query);

            if($result){
                if($result && mysqli_num_rows($result)>0){
                    $user_data=mysqli_fetch_assoc($result);

                    if ($user_data['studpass'] == $studpass) {
                        $_SESSION['studUsername'] = $user_data['studUsername'];  // Store studid in session
                        header("location: studentpage.php");  // Redirect to student page
                        die;
                    }
                }
            }
            echo "<script>alert('Oops! Wrong ID or Password')</script>";
        }
        else{
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
                <header>Student Login</header>
                <form action="../../pages/student/loginStud.php" method="POST">
                    
                    <div class="field input">
                        <label>Username </label>
                        <input type="text" name="studUsername" required>
                    </div>

                    <div class="field input">
                        <label>Password </label>
                        <input type="password" name="studpass" required>
                    </div>

                    <div class="field">
                        <input type="submit" class="btn"name="submit" value="Login" required>
                    </div>
                    <div class="links">
                        Don't have account? <a href="../../pages/student/signupStud.php">Sign Up</a>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>