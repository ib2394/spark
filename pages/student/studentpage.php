<?php
    session_start();
    include ('../../config/config.php');
<<<<<<< Updated upstream
    session_start();
=======
>>>>>>> Stashed changes
    ## verify if the session user is student
    //if(isset($_SESSION['studid']) == "studid" && $_SESSION['studUsername'] == "studUsername")

    $studid = $_SESSION['studid'];

    $sql = "SELECT * FROM student WHERE studid = '$studid'";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_assoc($result);

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        // Retrieve the logged-in studUsername from the session
        if (!isset($_SESSION['studid'])) {
            echo "<script type='text/javascript'>alert('Student Username is not set in the session');</script>";
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #BFACE2;
        }
        .header {
            background-color: #BFACE2;
            padding: 20px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            color: black;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 2rem;
        }
        .navbar ul {
            list-style: none;
            display: flex;
            gap: 1rem;
        }
        .navbar ul li {
            display: inline;
        }
        .navbar a:hover {
            background: #645CBB;
        }
        .navbar img.logo {
            width: 120px;
            cursor: pointer;
        }
        .image {
            width: 30px;
            display: flex;
            align-items: center;
            cursor: pointer;
            margin: 20px 10px;
        }
        .content {
            padding: 60px;
            text-align: center;
            background-color: white;
        }
        .content h1 {
            font-size: 36px;
            color: black;
            font-family: Archivo Black;
        }
        .icon {
            margin-top: 20px;
        }
        .icon img {
            width: 100px;
            height: 100px;
        }
        button{
            width: 200px;
            padding: 15px;
            margin: 20px 5px;
            text-align: center;
            border-radius: 25px;
            color: black;
            border: 2px;
            font-size: 20px;
            cursor: pointer;
            font-weight: 600;
        }
        button:hover{
            background-color: #645CBB;
            transition: 0.3s;
        }
        button:hover{
            color: white;

        }
        //for dropdown profile
        .dropdown {
            position: relative;
            display: inline-block;
            margin-left: -40%;
        }

        .dropdown img {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            cursor: pointer;
            margin-left: -40%;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
            margin-left: -7%;
        }
    </style>
</head>
<body>
    <div class="header">
        STUDENT
    </div>
    <div class="navbar">
        <img class="logo" src="../../pictures/logoParcel.png" alt="Logo">
        <ul>
            <li><a href="../../pages/student/studentinsert.php"><button type="button">INSERT</button></a></li>
            <li><a href="../../pages/student/studentupdate.php"><button type="button">UPDATE</button></a></li>
            <li><button type="button">REMOVE</button></li>
            <li><a href="../../pages/student/viewPay.php"><button type="button">PAY</button></a></li>
            <li><a href="../../pages/student/parcellist.php"><button type="button">VIEW</button></a></li>
        </ul>
        <img class="image" src="../../pictures/home.png" alt="Home">

        <div class="dropdown">
            <img src="<?php echo $row['ppStud']; ?>" alt="Avatar" class="student-pic">
            <div class="dropdown-content">
                <a href="#">Edit Profile</a>
                <a href="../../pages/other/logout.php">Logout</a>
            </div>
        </div>
    </div>

    <div class="content">
        <h1>WELCOME TO STUDENT PAGE</h1>
        <div class="icon">
            <img src="../../pictures/student icon.png" alt="Student Icon">
        </div>
    </div>
    <div class="logout-button">
    <form action="../../pages/other/mainPage.php" method="post">
        <button type="submit">Logout</button>
    </form>
    </div>
</body>
</html>