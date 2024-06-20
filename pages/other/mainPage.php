<?php
    include ('../../config/config.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>SPARK System</title>
        <link rel="stylesheet" href="../../css/style.css" >
        <link rel="stylesheet" type="text" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">
    </head>
    
    <body>
        <div class="banner">
            <div class="navbar">
                <img class="logo" src="../../pictures/logoParcel.png" action="../../pages/other/mainPage.php"> 
                <ul class="menu">
                    <li><a href="../../pages/other/pricing.php">Pricing</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">About</a></li>
                </ul>
            </div>
            <div class="content">
                <h1>Welcome to SPARK</h1>
                <div>
                    <a href="../../pages/other/loginAll.php">
                    <button type="login">START</button> 
                </div>
            </div>
        </div>
    </body>

    <body>
      <div class="cointainer">
        <div class="slides">
          <h2>SPARK ready for you</h2>
        </div>
      </div>
    
        <!-- Enhanced Footer -->
      <footer style="background-color: #2C2C2C; color: white; padding: 40px 20px; font-family: Arial, sans-serif;">
        <div style="display: flex; justify-content: space-between; flex-wrap: wrap; max-width: 1200px; margin: 0 auto;">

          <!-- Company Section -->
          <div style="flex: 1; min-width: 200px; margin: 10px;">
              <h3 style="border-bottom: 1px solid #8A2BE2; padding-bottom: 10px; color: white;">Company</h3>
              <ul style="list-style-type: none; padding: 10px;">
              <a><li style="color: #A9A9A9; margin-bottom: 10px;">About Us</li></a>
              <li style="color: #A9A9A9; margin-bottom: 10px;">Our Services</li>
              <li style="color: #A9A9A9; margin-bottom: 10px;">Privacy Policy</li>
            </ul>
          </div>

          <!-- Get Help Section -->
          <div style="flex: 1; min-width: 200px; margin: 10px;">
            <h3 style="border-bottom: 1px solid #8A2BE2; padding-bottom: 10px;">Get Help</h3>
            <ul style="list-style-type: none; padding: 10px;">
              <li><a href="#" style="color: #A9A9A9; text-decoration: none;">FAQ</a></li>
              <li><a href="#" style="color: #A9A9A9; text-decoration: none;">Order Status</a></li>
              <li><a href="#" style="color: #A9A9A9; text-decoration: none;">Payment Options</a></li>
            </ul>
          </div>

          <!-- Follow Us Section -->
          <div style="flex: 1; min-width: 200px; margin: 10px;">
            <h3 style="border-bottom: 1px solid #8A2BE2; padding-bottom: 10px;">Follow Us</h3>
            <ul style="list-style-type: none; padding: 10px; display: flex; gap: 10px;">
              <li><a href="#" style="color: white; text-decoration: none;"><img src="../../pictures/facebook.png" alt="Facebook" style="width: 24px;"></a></li>
              <li><a href="#" style="color: white; text-decoration: none;"><img src="../../pictures/twitter.png" alt="Twitter" style="width: 24px;"></a></li>
              <li><a href="#" style="color: white; text-decoration: none;"><img src="../../pictures/instagram.png" alt="Instagram" style="width: 24px;"></a></li>
              <li><a href="#" style="color: white; text-decoration: none;"><img src="../../pictures/linkedin.png" alt="LinkedIn" style="width: 24px;"></a></li>
            </ul>
          </div>

          <!-- Contact Section -->
          <div style="flex: 1; min-width: 200px; margin: 10px;">
            <h3 style="border-bottom: 1px solid #8A2BE2; padding-bottom: 10px;">Contact Us</h3>
            <ul style="list-style-type: none; padding: 10px;">
              <li style="color: #A9A9A9; margin-bottom: 10px;">UiTM Cawangan Kampus Raub</li>
              <li style="color: #A9A9A9; margin-bottom: 10px;">Email: <a href="mailto:info@company.com" style="color: #8A2BE2; text-decoration: none;">sparkSystem@com.my</a></li>
              <li style= "color: #A9A9A9">Phone: <a href="tel:+1234567890" style="color: #8A2BE2; text-decoration: none;">+60-123456789</a></li>
            </ul>
          </div>

        </div>
        <div style="text-align: center; margin-top: 20px; font-size: 14px;">
          <p>&copy; 2024 SPARK. All rights reserved.</p>
        </div>
      </footer>
    </body>
</html>