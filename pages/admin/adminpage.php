<?php
    session_start();
    include ('../../config/config.php');

    $adminid = $_SESSION['adminid'];

    $sql = "SELECT * FROM admin WHERE adminid = '$adminid'";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_assoc($result);

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        // Retrieve the logged-in studUsername from the session
        if (!isset($_SESSION['adminid'])) {
            echo "<script type='text/javascript'>alert('Admin Username is not set in the session');</script>";
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #eceaff;
        }
        .header {
            background-color: #eceaff;
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
        .search{
            width: 20px;
        }
        .box{
            height: 20px;
            display: flex;
            cursor: pointer;
            padding: 10px 20px;
            background: #fff;
            border-radius: 30px;
            align-items: center;
            box-shadow: 0 10px 25px rgba(0, 0, 0 , 0.3)
        }
        .box:hover{
            width: 400px;
            outline: none;
            border: none;
            font-weight: 500;
            transition: 0.8s;
            background: transparent;
        }
        .box a .fas{
            color: #1daf;
            font-size: 18px;
        }
        .admin-pic{
            width: 30px;
            border-radius: 50%;
            cursor: pointer;
            margin-left: 50px;
        }
        .sub-menu-wrap{
            position: absolute;
            top: 100%;
            right: 10%;
            width:320px;
        }
        .sub-menu{
            background: #fff;
            padding: 20px;
            margin: 10px;
        }
        .user-info{
            display: flex;
            align-items: center;
        }
        .user-info h3{
            font-weight: 500;
        }
        .user-info img{
            width: 60px;
            border-radius: 15px;
            margin-right: 15px;
            top: 100%;
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
        ADMIN
    </div>
    <div class="navbar">
        <img class="logo" src="../../pictures/logoParcel.png" alt="Logo">
        <ul>
            <li><a href="../../pages/admin/adminupdate.php">
            <button type="button">UPDATE</button></a></li>

            <li><a href="#">
            <button type="button">REMOVE</button></a></li>

            <li><a href="../../pages/admin/admSearch.php">
            <button type="button">SEARCH</button></a></li>

            <li><a href="#">
            <button type="button">VIEWING</button></a></li>

        </ul>
        
        <div class="dropdown">
            <img src="<?php echo $row['ppAdm']; ?>" alt="Avatar" class="admin-pic">
            <div class="dropdown-content">
                <a href="adminupdate.php">Edit Profile</a>
                <a href="../../pages/other/logout.php">Logout</a>
            </div>
        </div>
    </div>

    <div class="content">
        <h1>WELCOME TO ADMIN PAGE</h1>
        <div class="icon">
            <img src="../../pictures/admin.png" alt="Admin Icon">
        </div>
    </div>
</div>
</body>
</html>