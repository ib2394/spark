<?php
session_start();
include '../../config/config.php';

if(isset($_POST['submit'])){
    /* capture values from HTML form */
    $EmpUsername = $_POST['empUsername'];
    $Emppass = $_POST['emppass'];
    $Empname = $_POST['empname'];
    $Empphone = $_POST['empphone'];
    $Jobtitle = $_POST['jobtitle'];

    /* execute SQL SELECT command */
    $sql = "SELECT empUsername FROM employee WHERE empUsername = '$EmpUsername'";
    //echo $sql;
    $query = mysqli_query($con, $sql);

    if (!$query) {
        die("Error: " . mysqli_error($con));
    }

    $row = mysqli_num_rows($query);

    if($row != 0){
        echo "<script>alert('The username is already existed'); 
                window.location.href = 'signupEmp.php';
                </script>";
            exit();
    }
    else{
            // Image upload handling
        if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
            $file = $_FILES['image'];

            $fileName = $_FILES['image']['name'];
            $fileTmpName = $_FILES['image']['tmp_name'];
            $fileSize = $_FILES['image']['size'];
            $fileError = $_FILES['image']['error'];
            $fileType = $_FILES['image']['type'];

            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

            $allowed = array('jpg','jpeg','png');

            if(in_array($fileActualExt, $allowed)) {
                if($fileError === 0) {
                    //file size must be < 10MB
                    if($fileSize < 10485760) {
                        echo $sql;
                        $fileNameNew = $EmpUsername.".".$fileActualExt;
                        $fileDestination = '../../ppUser/ppEmployee/'. $fileNameNew;

                        move_uploaded_file($fileTmpName, $fileDestination); //to upload file to a specific folder

                        /* execute SQL INSERT commands */
                        $sql2 = "INSERT INTO employee (empUsername, emppass, empname, empphone, jobtitle ,ppEmp) VALUES ('$EmpUsername','$Emppass', '$Empname', '$Empphone', '$Jobtitle','$fileDestination')";

                        if (mysqli_query($con, $sql2)) {
                            echo "<script>alert('Succesfully registered!'); 
                                window.location.href = 'loginEmp.php';
                                </script>";
                            exit();
                        } else {
                            echo "Error: " . mysqli_error($con);
                        }
                    } else {
                        echo "<script>
                            alert('File is too big!');
                        </script>";   
                    }
                } else {
                    echo "<script>
                        alert('There is an error in this file!');
                    </script>";  
                }
            } else {
                echo "<script>
                    alert('PNG, JPG, JPEG only!');
                </script>";  
            }
        }
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
        <title>Sign Up</title>
    </head>
    <body>
        <div class="page">
            <div class="box form-box">
                <header>Sign Up</header>
                <form name="spark_system" method="post" action="" enctype="multipart/form-data">
                    <div class="field input">
                        <label for="empUsername">Username </label>
                        <input type="text" name="empUsername" id="empUsername" autocomplete="off" required>
                    </div>

                    <div class="field input">
                        <label for="emppass">Password </label>
                        <input type="password" name="emppass" autocomplete="off" required>
                    </div>

                    <div class="field input">
                        <label for="empname">Full Name</label>
                        <input type="text" name="empname" autocomplete="off" required>
                    </div>

                    <div class="field input">
                        <label for="empphone">Phone Number </label>
                        <input type="text" name="empphone" autocomplete="off" required>
                    </div>

                    <div class="field input">
                        <label for="jobtitle">Job Title </label>
                        <input type="text" name="jobtitle" autocomplete="off" required>
                        <select>
                            <a>Delivery Boy</a>
                            <a>Management</a>
                        </select>
                    </div>

                    <div class="card">
                        <img src="../../pictures/default-avatar.png" id="profile-pic" style="margin-top: 10px; width: 20px; border-radius: 50%; object-fit: cover;">
                        <label for="input-file">Profile Picture</label>
                        <input type="file" name="image" accept="image/jpeg, image/png, image/jpg" id="input-file">
                    </div>
                    <script>
                        let profilePic = document.getElementById("profile-pic");
                        let inputfile = document.getElementById("input-file");

                        inputFile.onchange = function(){
                            profilePic.src = URLcreateObjectURL(inputFile.files[0]);
                        }
                    </script>

                    <div class="field">
                        <input type="submit" class="btn" name="submit" value="Sign Up" required>
                    </div>
                </form>

                <div class="links">
                    Already a member? <a href="../../pages/employee/loginEmp.php">Login</a>
                </div>
            </div>
        </div>
    </body>
</html>