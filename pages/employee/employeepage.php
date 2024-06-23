<?php
    include ('../../config/config.php');
<<<<<<< Updated upstream
    session_start();
    ## verify if the session user is employee
    //if(isset($_SESSION['empid']) == "empid" && $_SESSION['studUsername'] == "studUsername")

=======
    
>>>>>>> Stashed changes
    $empid = $_SESSION['empid'];

    $sql = "SELECT * FROM employee WHERE empid = '$empid'";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_assoc($result);
<<<<<<< Updated upstream

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        // Retrieve the logged-in studUsername from the session
        if (!isset($_SESSION['empid'])) {
            echo "<script type='text/javascript'>alert('employee Username is not set in the session');</script>";
            exit();
        }
    }
?>
=======
>>>>>>> Stashed changes

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        // Retrieve the logged-in studUsername from the session
        if (!isset($_SESSION['empid'])) {
            echo "<script type='text/javascript'>alert('Employee Username is not set in the session');</script>";
            exit();
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Page</title>
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
            gap: 6rem;
        }
        .navbar ul button {
             width: 200px;
            background: #645CBB;
            color: black;
            border: none;
            text-align: center;
            padding: 0.5rem 2rem;
            margin: 20px 10px;
            cursor: pointer;
            border-radius: 20px;
            font-size: 1rem;
            position: relative;
        }
        .navbar a:hover {
            background: #645CBB;
        }
        .navbar img.logo {
            width: 120px;
            cursor: pointer;
        }
        .image{
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
        EMPLOYEE
    </div>
    <div class="navbar">
        <img class="logo" src="../../pictures/logoParcel.png" alt="Logo">
        <ul>
            <li><a href="../../pages/employee/employeeupdate.php">
            <button type="button">UPDATE</button></a></li>

            <li><a href="#">
            <button type="button">REMOVE</button></a></li>

            <li><a href="../../pages/admin/admSearch.php">
            <button type="button">SEARCH</button></a></li>

            <li><a href="#">
            <button type="button">VIEW</button></a></li>

        </ul>
        
        <div class="dropdown">
<<<<<<< Updated upstream
            <img src="<?php echo $row['ppEmp']; ?>" alt="Avatar" class="admin-pic">
=======
            <img src="<?php echo $row['ppEmp']; ?>" alt="Avatar" class="emp-pic">
>>>>>>> Stashed changes
            <div class="dropdown-content">
                <a href="#">Edit Profile</a>
                <a href="../../pages/other/logout.php">Logout</a>
            </div>
        </div>
<<<<<<< Updated upstream
=======

>>>>>>> Stashed changes
    </div>

    <div class="content">
        <h1>WELCOME TO EMPLOYEE PAGE</h1>
        <div class="icon">
            <img src="../../pictures/employee.png" alt="Employee Icon">
        </div>
    </div>
</div>
</body>

<!--<body>
    <div class="header">
        EMPLOYEE
    </div>
    <div class="navbar">
        <img class="logo" src="../../pictures/logoParcel.png" alt="Logo">
        <ul>
            <li><a href="../../pages/employee/employeeupdate.php"><button type="button">UPDATE</button></a></li>
            <button type="button">REMOVE</button>
            <button type="button">SEARCH</button>
            <button type="button">VIEWING</button>
            <img class="image" src="../../pictures/home.png" alt="Home">
        </ul>
    </div>

    <div class="dropdown">
        <img src="<?php echo $row['ppEmp']; ?>" alt="Avatar" class="emp-pic">
        <div class="dropdown-content">
            <a href="#">Edit Profile</a>
            <a href="../../pages/other/logout.php">Logout</a>
        </div>
    </div>

    <div class="content">
        <h1>WELCOME TO EMPLOYEE PAGE</h1>
        <div class="icon">
            <img src="../../pictures/employee icon.png" alt="Employee Icon">
        </div>
    </div>
</body> -->
</html>
