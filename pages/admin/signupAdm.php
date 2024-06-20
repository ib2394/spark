<?php
/* include db connection file syaaaa */
include '../../config/config.php';

if(isset($_POST['submit'])){
    /* capture values from HTML form */
    $AdmUsername = $_POST['admUsername'];
    $Admpass = $_POST['admpass'];
    $Admname = $_POST['admname'];
    $Admphone = $_POST['admphone'];

    /* execute SQL SELECT command */
    $sql = "SELECT admUsername FROM admin WHERE admUsername = '$AdmUsername'";
    echo $sql;
    $query = mysqli_query($con, $sql);

    if (!$query) {
        die("Error: " . mysqli_error($con));
    }

    $row = mysqli_num_rows($query);

    if($row != 0){
        echo "<script>alert('The username is already existed'); 
                window.location.href = 'signupAdm.php';
                </script>";
            exit();
    }
    else{
        /* execute SQL INSERT commands */
        $sql2 = "INSERT INTO admin (admUsername, admpass, admname, admphone) VALUES ('$AdmUsername','$Admpass', '$Admname', '$Admphone')";

        if (mysqli_query($con, $sql2)) {
            echo "<script>alert('Succesfully registered!'); 
                window.location.href = 'loginAdm.php';
                </script>";
            exit();
        } else {
            echo "Error: " . mysqli_error($con);
        }
    }
}

/* close db connection */
mysqli_close($con);

// create new user id
function createUserId(){
    include '../../config/config.php';

    // Find the highest current user ID
    $sqlSelectMaxId = "SELECT admUsername FROM admin ORDER BY admUsername DESC LIMIT 1";
    $result = mysqli_query($con, $sqlSelectMaxId);
    if (!$result) {
        die("Error: " . mysqli_error($con));
    }

    $row = mysqli_fetch_assoc($result);
    $lastId = $row['admUsername'];
    
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
    $sqlSelectMaxId = "SELECT admUsername FROM parcel ORDER BY parcelid DESC LIMIT 1";
    $result = mysqli_query($con, $sqlSelectMaxId);
    if (!$result) {
        die("Error: " . mysqli_error($con));
    }

    $row = mysqli_fetch_assoc($result);
    $lastId = $row['admUsername'];
    
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
            <form name="spark_system" method="post" action="../../pages/admin/signupAdm.php" enctype="multipart/form-data">

                <div class="field input">
                    <label for="admUsername">Username</label>
                    <input type="text" name="admUsername" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="admpass">Password </label>
                    <input type="password" name="admpass" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="admname">Full Name</label>
                    <input type="text" name="admname" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="admphone">Phone Number </label>
                    <input type="text" name="admphone" autocomplete="off" required>
                </div>

                <!-- <div class="field input">
                    <label for="admPic">Profile Picture</label>
                    <input type="file" name="admPic" id="admPic" accept="image/*">
                </div> -->

                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Sign Up" required>
                </div>
            </form>
            <div class="links">
                Already a member? <a href="../../pages/admin/loginAdm.php">Login</a>
            </div>
        </div>
    </div>
</body>
</html>