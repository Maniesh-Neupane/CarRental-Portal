<?php
session_start(); // Start the session
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Listings</title>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f8f9fa; /* Light background for better  */
        }

        /* Navbar */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 2rem 2rem 1rem 2rem; /* Increas padding-top to 2rem */
            background-color: #333;
            color: #fff;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 100;
        }

        /* Navbar links */
        .navbar .nav-links {
            display: flex;
            gap: 12rem; /* Increased gap between the navbar links */
            list-style: none;
        }

        .navbar .nav-links li a {
            color: #fff;
            text-decoration: none;
            font-size: 1rem;
            transition: color 0.3s ease;
        }

        .navbar .nav-links li a:hover {
            color: #40e0d0;
        }

        /* Hero section */
        .hero {
            position: relative;
            height: 100vh;
            background: url("images/image2.jpg") no-repeat center center/cover;
            color: #fff;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            margin-top: 0; /*  margin-top to eliminate white gap */
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: 1;
        }

        .hero-text {
            position: relative;
            z-index: 2;
        }

        .hero-text h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .hero-text p {
            font-size: 1.2rem;
            line-height: 1.5;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Content Section */
        .content {
            padding: 20px;
            text-align: center;
            margin-top: 0; /* margin to remove white gap */
        }

        /* Intro Section */
        .intro-section {
            background-color: #f8f9fa;
            padding: 50px 20px;
            text-align: center;
            color: black;
        }

        .intro-section h1 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        .intro-section p {
            font-size: 20px;
            line-height: 1.5;
            margin-bottom: 50px;
        }

        /* Features Section */
        .features-section {
            background-color: #f0f0f0;
            padding: 40px 20px;
            text-align: center;
        }

        .features-section h2 {
            font-size: 30px;
            margin-bottom: 30px;
            color: #333;
        }

        .features-section ul {
            list-style: none;
            padding: 0;
        }

        .features-section ul li {
            font-size: 18px;
            margin-bottom: 15px;
            color: #555;
        }

        .features-section ul li:before {
            content: "\2022";
            color: #007bff;
            font-weight: bold;
            margin-right: 10px;
        }

        /* Car Container */
        .car-container {
            display: grid; /* Using grid layout for 3 cars per row */
            grid-template-columns: repeat(3, 1fr); /* 3 columns */
            gap: 20px; /* Gap between cars */
            margin-top: 50px;
            padding-bottom: 50px;
        }

        /* Car Card */
        .car-card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.4s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }

        .car-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.2);
        }

        /* Car Image */
        .car-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        /* Car Details */
        .car-card .details {
            padding: 15px;
        }

        .car-card h3 {
            margin: 0 0 10px;
            font-size: 18px;
            color: #333;
        }

        .car-card p {
            margin: 5px 0;
            color: #555;
        }

        /* Button */
        .car-card .btn {
            display: block;
            width: 100%; /* Make button full width */
            text-align: center;
            background: #007bff;
            color: #fff;
            padding: 10px;
            margin-top: 10px;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        .car-card .btn:hover {
            background: #0056b3;
        }
    </style>

    <script>
        // Function to check if the user is logged in before proceeding to booking
        function checkLoginStatus(carId) {
            <?php
            if (!isset($_SESSION['email'])) { // Check if the user is not logged in
                echo 'alert("Please log in to book a car.");'; // Show the login alert
            } else { // If the user is logged in, redirect to the booking page
                echo 'window.location.href = "booking.php?id=" + carId;';
            }
            ?>
        }
    </script>

</head>
<body>

<!-- Navbar -->
<header class="navbar">
    <nav>
        <ul class="nav-links">
            <li><a href="#">HOME</a></li>
            <li><a href="aboutus.html">ABOUT</a></li>
            <li><a href="#">SERVICES</a></li>
            <li><a href="contactus.html">CONTACT</a></li>
            <li><a href="login.php">LOGIN</a></li>
            <li><a href="register.php">REGISTER</a></li> 
        </ul>
    </nav>
</header>

<!-- Hero Section -->
<section class="hero">
    <div class="hero-text">
        <h1>Make Your Trip Enjoyable</h1>
        <p>It's a never-ending battle of making your cars better and also trying to be better yourself.</p>
    </div>
</section>

<!-- Content Section -->
<div class="content">
    <!-- Intro Section -->
    <div class="intro-section">
        <!-- Intro content here -->
    </div>

    <!-- Features Section -->
    <div class="features-section">
        <h2>Why Choose Us?</h2>
        <ul>
            <li><strong>Best price guarantee:</strong> If you find a lower price, we’ll refund the difference.</li>
            <li><strong>No cancellation fees:</strong> Up to 2 days before collecting your vehicle.</li>
            <li><strong>No hidden extras to pay:</strong> Everything is included in the price.</li>
        </ul>
    </div>

    <!-- Car Listings -->
    <h2>Our Cars List</h2>

    <div class="car-container">
        <?php
        require_once('connection.php');

        // Fetch cars
        $carsQuery = "SELECT * FROM cars WHERE AVAILABLE = 'Y'";
        $carsResult = $con->query($carsQuery);

        if ($carsResult->num_rows > 0) {
            while ($car = $carsResult->fetch_assoc()) {
                echo '<div class="car-card">';
                echo '<img src="images/' . htmlspecialchars($car['CAR_IMG']) . '" alt="' . htmlspecialchars($car['CAR_NAME']) . '">';
                echo '<div class="details">';
                echo '<h3>' . htmlspecialchars($car['CAR_NAME']) . '</h3>';
                echo '<p>Fuel Type: ' . htmlspecialchars($car['FUEL_TYPE']) . '</p>';
                echo '<p>Capacity: ' . htmlspecialchars($car['CAPACITY']) . '</p>';
                echo '<p>Price Per Day: ' . htmlspecialchars($car['PRICE']) . '</p>';
                // Removed the "Book Now" button
                // echo '<button onclick="checkLoginStatus(' . $car['CAR_ID'] . ')" class="btn">Book Now</button>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p>No cars available at the moment.</p>';
        }
        ?>
    </div>
</div>

</body>
</html>
