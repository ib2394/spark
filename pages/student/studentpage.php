<?php
    include ('../../config/config.php');
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
            <li><button type="button">SEARCH</button></li>
            <li><button type="button">VIEWING</button></li>
        </ul>
        <img class="image" src="../../pictures/home.png" alt="Home">
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
