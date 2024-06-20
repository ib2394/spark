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
    </style>
</head>
<body>
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
    <div class="content">
        <h1>WELCOME TO EMPLOYEE PAGE</h1>
        <div class="icon">
            <img src="../../pictures/employee icon.png" alt="Employee Icon">
        </div>
    </div>
</body>
</html>
