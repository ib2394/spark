<?php
    session_start();

    include ('../../config/config.php');

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $empUsername = $_POST['empUsername'];
        $emppass = $_POST['emppass'];

        if(!empty($empUsername) &&!empty($emppass) &&!is_numeric($empUsername)){
            $query="select * from employee where empUsername='$empUsername' limit 1";
            $result=mysqli_query($con, $query);

            if($result){
                if($result && mysqli_num_rows($result)>0){
                    $user_data=mysqli_fetch_assoc($result);

                    if ($user_data['emppass'] == $emppass) {
                        $_SESSION['empid'] = $user_data['empid'];  // Store studid in session
                        $_SESSION['empUsername'] = $user_data['empUsername'];  // Store studUsername in session
                        header("location: employeepage.php");  // Redirect to student page
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
                <header>Employee Login</header>
                <form action="../../pages/employee/loginEmp.php" method="POST">

                    <div class="field input">
                        <label>Username </label>
                        <input type="text" name="empUsername" required>
                    </div>

                    <div class="field input">
                        <label>Password </label>
                        <input type="password" name="emppass" required>
                    </div>

                    <div class="field">
                        <input type="submit" class="btn"name="submit" value="Login" required>
                    </div>
                    <div class="links">
                        Don't have account? <a href="../../pages/employee/signupEmp.php">Sign Up</a>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>