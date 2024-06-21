
<?php
/* include db connection file syaaaa */
include '../../config/config.php';

if(isset($_POST['submit'])){
    /* capture values from HTML form */
    $empUsername = $_POST['empUsername'];
    $emppass = $_POST['emppass'];
    $empname = $_POST['empname'];
    $empphone = $_POST['empphone'];
    $jobtitle = $_POST['jobtitle'];

    /* execute SQL SELECT command */
    $sql = "SELECT empUsername FROM employee WHERE empUsername = '$empUsername'";
    
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
                    $fileNameNew = $empUsername.".".$fileActualExt;
                    $fileDestination = '../../ppUser/ppEmployee/'. $fileNameNew;

                    move_uploaded_file($fileTmpName, $fileDestination); //to upload file to a specific folder

                    /* execute SQL INSERT commands */
                    $sql2 = "INSERT INTO employee (empUsername, emppass, empname, empphone, jobtitle, ppEmp) VALUES ('$empUsername','$emppass', '$empname', '$empphone', '$jobtitle', '$fileDestination')";

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

/* close db connection */
mysqli_close($con);

// create new user id
function createUserId(){
    include '../../config/config.php';

    // Find the highest current user ID
    $sqlSelectMaxId = "SELECT empUsername FROM employee ORDER BY empUsername DESC LIMIT 1";
    $result = mysqli_query($con, $sqlSelectMaxId);
    if (!$result) {
        die("Error: " . mysqli_error($con));
    }

    $row = mysqli_fetch_assoc($result);
    $lastId = $row['empUsername'];
    
    // Extract the numeric part, increment it, and create the new ID
    $numericPart = intval(substr($lastId, 1)); // assuming the prefix "U" is always 1 character
    $newNumericPart = $numericPart + 1;
    if ($newNumericPart < 10) {
        $newUserId = 'U0' . $newNumericPart;
    } else {
        $newUserId = 'U' . $newNumericPart;
    }
    return $newUserId;
}

// create new user details id
function createUserDetailsId(){
    include '../../config/config.php';

    // Find the highest current user details ID
    $sqlSelectMaxId = "SELECT empUsername FROM parcel ORDER BY parcelid DESC LIMIT 1";
    $result = mysqli_query($con, $sqlSelectMaxId);
    if (!$result) {
        die("Error: " . mysqli_error($con));
    }

    $row = mysqli_fetch_assoc($result);
    $lastId = $row['empUsername'];
    
    // Extract the numeric part, increment it, and create the new ID
    $numericPart = intval(substr($lastId, 2)); // assuming the prefix "UD" is always 2 characters
    $newNumericPart = $numericPart + 1;
    if ($newNumericPart < 10) {
        $newUserId = 'UD0' . $newNumericPart;
    } else {
        $newUserId = 'UD' . $newNumericPart;
    }
    return $newUserId;
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
                <form name="spark_system" method="post" action="#">
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
                    </div>

                    <div class="card">
                        <img src="../../pictures/default-avatar.png" id="profile-pic" style="margin-top: 10px; width: 20px; border-radius: 50%; object-fit: cover;">
                        <label for="input-file">Profile Picture</label>
                        <input type="file" name="image" accept="image/jpeg, image/png, image/jpg" id="input-file">
                    </div>

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