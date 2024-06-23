<?php
    include ('../../config/config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Page</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }
        .header {
            background-color: #111;
            color: #fff;
            padding: 20px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            background-color: #111;
            color: #fff;
        }
        .navbar ul {
            list-style: none;
            display: flex;
            gap: 1rem;
        }
        .navbar ul li {
            display: inline;
        }
        .navbar a {
            text-decoration: none;
            color: #fff;
        }
        .navbar a:hover {
            background-color: #645CBB;
            border-radius: 25px;
            padding: 15px 30px; /* increased padding for larger clickable area */
            transition: background-color 0.3s;
        }
        .navbar img.logo {
            width: 120px;
            cursor: pointer;
        }
        .image {
            width: 30px;
            cursor: pointer;
            margin: 0 10px;
        }
        .content {
            padding: 60px;
            text-align: center;
        }
        .content h1 {
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .content h1 img {
            width: 60px;
            margin-right: 10px;
        }
        .icon {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        .icon img {
            width: 100px;
            height: 100px;
        }
        .logout-button {
            text-align: center;
            margin-top: 20px;
        }
        button {
            padding: 15px 30px;
            font-size: 18px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        button:hover {
            background-color: #0056b3;
            transform: translateY(-2px); /* slight lift on hover */
        }
        .benefits {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin-top: 40px;
        }
        .benefits .benefit {
            text-align: center;
        }
        .benefits .benefit img {
            width: 150px;
            margin-bottom: 10px;
        }
        .benefits .benefit p {
            font-size: 20px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <img class="logo" src="../../pictures/logoParcel.png" alt="Logo">
        <ul>
            <li><a href="../../pages/employee/employeeupdate.php">UPDATE</a></li>
            <li><a href="#">REMOVE</a></li>
            <li><a href="../../pages/employee/viewPay.php">PAY</a></li>
            <li><a href="../../pages/employee/studentslist.php">VIEWING</a></li>
        </ul>
        <img class="image" src="../../pictures/home.png" alt="Home">
    </div>
    <div class="content">
        <h1><img src="../../pictures/employee.png" alt="Employee Icon"> WELCOME TO EMPLOYEE PAGE</h1>
        
        <div class="benefits">
            <div class="benefit">
                <img src="../../pictures/parcel.png" alt="Parcel">
                <p>SPARK. The best way to manage the parcels you love.</p>
            </div>
            <div class="benefit">
                <img src="../../pictures/fast.png" alt="Fast">
                <p>Ensure fast delivery service for all our parcels.</p>
            </div>
            <div class="benefit">
                <img src="../../pictures/employeetask.png" alt="Employee Task">
                <p>Track parcels efficiently with our Employee Task feature.</p>
            </div>
        </div>
    </div>
    <div class="logout-button">
        <form action="../../pages/other/mainPage.php" method="post">
            <button type="submit">Logout</button>
        </form>
    </div>
</body>
</html>
