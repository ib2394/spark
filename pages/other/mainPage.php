<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SPARK System</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap">
    <script defer src="activePage.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            box-sizing: border-box;
        }
        .banner {
            width: 100%;
            height: 100vh;
            background-color: #BFACE2;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
        .navbar {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            position: absolute;
            top: 0;
            left: 0;
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .navbar .logo {
            width: 100px;
            cursor: pointer;
        }
        .navbar .menu {
            list-style: none;
            display: flex;
        }
        .navbar .menu li {
            margin: 0 15px;
        }
        .navbar .menu li a {
            text-decoration: none;
            text-transform: uppercase;
            color: black;
            font-weight: 500;
            padding: 10px;
            border-radius: 15px;
            transition: background-color 0.3s;
        }
        .navbar .menu li a:hover {
            background-color: #645CBB;
            color: black;
        }
        .content{
          margin-top: 30%; /* Adjust margin-top as needed */
        }
        .content h1 {
            font-size: 60px;
            font-weight: 800;
            color: white;
        }
        .content button {
            width: 200px;
            padding: 15px;
            margin: 20px 5px;
            text-align: center;
            border-radius: 25px;
            color: black;
            border: 2px solid transparent;
            font-size: 20px;
            cursor: pointer;
            font-weight: 600;
            background-color: white;
            transition: background-color 0.3s, color 0.3s;
        }
        .content button:hover {
            background-color: #645CBB;
            color: white;
        }
        .container {
            width: 100%;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #fff;
            text-align: center;
        }
        .container .word {
            max-width: 650px;
        }
        .container .word h2 {
            font-size: 40px;
            font-weight: 600;
            color: #000;
        }
        .container .word h4 {
            font-size: 20px;
            font-weight: 400;
            color: #555;
        }
        .box {
            max-width: 800px;
            margin: 0 auto;
        }
        .box h1 {
            text-align: center;
            margin-bottom: 30px;
        }
        .faq-item {
            margin-bottom: 20px;
        }
        .question {
            background-color: #f0f0f0;
            padding: 10px;
            border: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
        }
        .answer {
            display: none;
            padding: 10px;
            background-color: #ffffff;
            border: 1px solid #ccc;
        }
        .answer.show {
            display: block;
        }
        /* pricing page */
        .section h1 {
            text-align: center;
            font-size: 40px;
            color: black;
            margin-top: 80px;
        }
        .container {
            display: flex;
            justify-content: center;
            gap: 200px;
            margin-top: -70px;
        }
        .pic {
          display: flex;
          flex-direction: column;
          align-items: center;
          background-color: #F7EFE5;
          padding: 100px;
          border-radius: 10px;
          box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
          text-decoration: none;
          color: black;
          width: 150px;
          height: 150px;
          justify-content: center;
          transition: transform 0.2s;
        }
        .pic img {
          width: 300px;
          height: 250px;
          justify-content: center;
        }
        .pic p {
          margin: 6px 0 0 0;
          font-weight: bold;
          font-size: 28px;
        }
        .pic:hover{
          transform: translateY(-10px);
        }

        /* Service css */
        .service body {
          height: 100%;
          margin: 0;
          display: flex;
          justify-content: center;
          align-items: center;
        }

        .wrapper {
          background-color: #ad9fc8;
          width: 580px;
          border-radius: 15px;
          padding: 20px;
          box-shadow: 10px 10px 15px rgba(0, 0, 0, 0.4);
        }

        .wrapper h2 {
          text-align: center;
        }

        hr {
          width: 100px;
          margin: 10px auto;
        }

        .service {
          display: flex;
        }

        .type {
          margin: 8px;
        }

        .type:hover img, .type1:hover img {
          transform: scale(1.1);
          border: 1px solid black;
        }

        h4, p {
          text-align: center;
          font-size: 17px; /* Correct the spacing here */
          margin: 7px;
          margin-right: 30px;
        }

        .service img {
          width: 190px;
          height: 190px;
          border-radius: 50%;
          margin: 30px;
          margin-right: 45px;
          cursor: pointer;
        }

        /*Auni Contact Us CSS*/
        .contact-section {
            padding: 20px;
        }
        .contact-header {
            text-align: center;
            font-size: 3em;
            font-weight: bold;
            color: black;
            letter-spacing: 2px;
            text-shadow: 2px 2px #666;
            margin: 40px 0;
        }
        .contact-info {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .contact-info img {
            width: 150px;
            height: 150px;
            border-radius: 15px; /* Slightly rounded corners */
            margin-right: 20px;
            border: 2px solid #BFACE2; /* Border color matching the background */
            background-color: white; /* Ensures there's no black border */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); /* Adds a shadow for better visual separation */
        }
        .contact-info div {
            margin-left: 10px;
            text-align: left;
        }
        .contact-name {
            margin: 0;
            font-size: 1.6em;
            font-weight: bold;
            color: #333;
        }
        .contact-phone {
            margin: 0;
            font-size: 1.2em;
            color: #666;
        }

        /* (Aminah) About Us CSS */
        .about-us{
            min-height: 100vh;
            padding: 80px 0px;
            background-color: #BFACE2;
        }
        .container{
            max-width: 1200px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 30px;
            border-radius: 10px;
            margin: 0px auto;
        }
        .about-image{
            width: 50%;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
        .about-image img{
            display: block;
            width: 85%;
            height: auto;
            margin-left: 40px;
            transition: transform 0.3s ease;
        }
        .about-image:hover img{
            transform: scale(1.2);
        }
        .about-content{
            width: 50%;
            margin-left: 40px;
        }
        .about-content h1{
            color: black;
            font-size: 34px;
            margin-bottom: 20px;
        }
        .about-content p{
            color: black;
            font-size: 17px;
            line-height: 1.6;
            margin-bottom: 20px;
        }

    </style>
</head>
<body>
    <div class="banner">
        <div class="navbar">
            <img class="logo" src="../../pictures/logoParcel.png" alt="SPARK Logo">
            <ul class="menu">
                <li><a href="#pricing">Pricing</a></li>
                <li><a href="#service">Services</a></li>
                <li><a href="#contactus">Contact Us</a></li>
                <li><a href="#about">About</a></li>
            </ul>
        </div>
        <div class="content">
            <h1>Welcome to SPARK</h1>
            <div>
                <a href="../../pages/other/loginAll.php">
                    <button type="button">Get Started</button>
                </a>
            </div>
        </div>
    </div>

    <!-- (ib) Pricing Navbar  -->
    <body>
        <div class="section" id="pricing">
          <h1>Price for each size</h1>
          <div class="container">
            <a href="#" class="pic">
                <p>Small</p>
                <img src="../../pictures/smallParcel.png">
                <p>RM1</p>
            </a>
            <a href="#" class="pic">
                <p>Medium</p>
                <img src="../../pictures/medParcel.png">
                <p>RM2</p>
            </a>
            <a href="#" class="pic">
                <p>Large</p>
                <img src="../../pictures/bigParcel.png">
                <p>RM3</p>
            </a>
          </div>
      </div>
  </body>

  <!-- (aminah) Services that SPARK provided -->
  <body>
    <div class="section" id="service">
        <h2>SERVICES</h2>
        <hr>
        <div class="service">
            <div class="type">
                <img src="img/delivery.png">
                <h4>DELIVERY</h4>
                <p>RM 1/parcel</p>
            </div>
            <div class="type1">
                <img src="img/pickup.png">
                <h4>PICK UP</h4>
                <p>No Charge</p>
            </div>
        </div>
    </div>
  </body>

      <!-- (auni) Contact Us  -->
      <body>
        <div class="section" id="contactus">
          <div class="contact-section">
            <h2 class="contact-header">Contact Us</h2>
            
            <div class="contact-info">
                <img src="./public/ibtisam.png" alt="IBTISAM BINTI ASRUL HAFIZ">
                <div>
                    <p class="contact-name">IBTISAM BINTI ASRUL HAFIZ</p>
                    <p class="contact-phone">(+6011-55507913)</p>
                </div>
            </div>
            
            <div class="contact-info">
                <img src="./public/atiqah.jpg" alt="NUR ATIQAH ZULAIKA BINTI ISMAIL">
                <div>
                    <p class="contact-name">NUR ATIQAH ZULAIKA BINTI ISMAIL</p>
                    <p class="contact-phone">(+6018-2139632)</p>
                </div>
            </div>

            <div class="contact-info">
                <img src="./public/auni.png" alt="NURUL AUNI BINTI MOHAMAD MOHLIS" width: 150px;
                height: 100px;> 
                <div>
                    <p class="contact-name">NURUL AUNI BINTI MOHAMAD MOHLIS</p> 
                    <p class="contact-phone">(+6019-8142770)</p>
                </div>
            </div>

            <div class="contact-info">
                <img src="./public/aminah.jpg" alt="SITI AMINAH BINIT AIDI">
                <div>
                    <p class="contact-name">SITI AMINAH BINIT AIDI</p>
                    <p class="contact-phone">(+6019-58197775)</p>
                </div>
            </div>
          </div>
        </div>
      </body>

    <!-- (Aminah) About  -->
    <body>
      <div class="section" id="about">
        <section class="about-us"> 
            <div class="container">
                <div class="about-image">
                    <img src="../../pictures/logoParcel.png">
                </div>
                <div class="about-content">
                    <h1>ABOUT US</h1>
                    <p>SPARK SYSTEM was founded by a group of UiTM Raub students named Ibtisam, Atiqah, Aminah, and Auni. It was initially developed at UiTM Raub, where students discovered it. It is a mechanism that allows students to select whether to pick up their packages or have them delivered to their homes. After many thoughts and complaints, we decided to build this approach to make it easier for students to get their hands on their packages.</p>
                </div>
            </div>
        </section>
      </div>
    </body>


    <!-- Help Desk -->
    <body>
      <div class="box">
          <h1>SPARK FAQ</h1>

          <div class="faq-item">
              <button class="question">What is SPARK?</button>
              <div class="answer">SPARK, a parcel management service established by UiTM Kampus Raub, facilitates the distribution of online-ordered parcels for students. Established in 2016 to address the challenges students faced in parcel collection, SPARK is part of UiTM Raub's efforts to streamline and enhance the parcel pickup process, ensuring convenience and efficiency without disruption.</div>
          </div>

          <div class="faq-item">
              <button class="question">Benefits For Spark Users</button>
              <div class="answer">Spark provides UiTM Raub students with a highly convenient and efficient system for managing and receiving their parcels, ensuring a streamlined process that saves time and reduces hassle.</div>
          </div>
      </div>
    </body>
      
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const questions = document.querySelectorAll('.question');

            questions.forEach(function (question) {
                question.addEventListener('click', function () {
                    const answer = this.nextElementSibling;
                    answer.style.display = (answer.style.display === 'block') ? 'none' : 'block';
                });
            });
        });
    </script>

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
