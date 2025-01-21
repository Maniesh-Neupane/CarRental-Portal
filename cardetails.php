<?php 
require_once('connection.php');
session_start();

// Check if the session variable 'email' exists
if (!isset($_SESSION['email'])) {
    // If not, redirect the user to the login page
    header("Location: login.php");
    exit;
}

$value = $_SESSION['email']; // User's email from session

// Fetch user details from the database
$sql = "SELECT * FROM users WHERE EMAIL = '$value'";
$name = mysqli_query($con, $sql);
$rows = mysqli_fetch_assoc($name);

// Fetch all cars, regardless of availability
$sql2 = "SELECT * FROM cars";
$cars = mysqli_query($con, $sql2);

// Check if user has already booked a car
$bookedCarsSql = "SELECT * FROM booking WHERE EMAIL = '$value'";
$bookedCarsResult = mysqli_query($con, $bookedCarsSql);
$bookedCars = [];
while ($bookedCar = mysqli_fetch_assoc($bookedCarsResult)) {
    $bookedCars[] = $bookedCar['CAR_ID'];  // Store booked car IDs
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Car Details</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box; 
        }

        /* Body styling */
        body {
            background: url("images/c2.jpg"); 
            background-position: center; 
            background-size: cover; 
            font-family: Arial, sans-serif; 
        }

        /* Navbar styling */
        .navbar {
            background-color: rgba(0, 0, 0, 0.7); 
            padding: 10px;
            color: white; 
        }

        /* Navbar menu links styling */
        .navbar .menu ul {
            list-style: none; 
            display: flex; 
            justify-content: space-around; 
        }

        .navbar .menu ul li {
            margin-right: 20px; 
        }

        .navbar .menu ul li a {
            text-decoration: none; 
            color: white; 
            font-weight: bold; 
        }

        /* White section styling */
        .white-section {
            background-color: white; 
            text-align: center; 
            padding: 30px 20px; 
            margin-top: 7px; 
        }

        /* Styling the heading */
        .white-section h2 {
            font-size: 2.5rem; 
            color: #333; 
            font-weight: 600;
        }

        /* Car list heading */
        .overview {
            text-align: center; 
            color: white; 
            margin-top: 20px; 
            font-size: 2rem; 
        }

        /* Car container styling */
        .car-container {
            display: flex; 
            flex-wrap: wrap; 
            justify-content: space-between; 
            padding: 20px;
            margin: 0 auto;
        }

        /* Styling each car box */
        .box {
            width: 30%; 
            background: white; 
            border-radius: 5px; 
            margin-bottom: 20px; 
            text-align: center; 
            padding: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2); 
            transition: transform 0.3s ease; 
        }

        /* Hover effect */
        .box:hover {
            transform: scale(1.05); 
        }

        /* Car image styling */
        .box img {
            max-width: 100%; 
            height: 150px; 
            object-fit: cover; 
            border-radius: 5px; 
        }

        /* Faded style for booked cars */
        .booked {
            opacity: 0.5; 
        }

        /* Button styling */
        .button {
            display: inline-block;
            background: #ff7200; 
            color: white; 
            padding: 10px 20px;
            border: none; 
            border-radius: 5px; 
            cursor: pointer; 
            margin-top: 10px; 
            text-decoration: none; 
        }

        /* Disabled button */
        .button.disabled {
            background: gray; 
            cursor: not-allowed; 
        }

        /* Booking status */
        .status {
            font-size: 14px;
            font-weight: bold;
            color: red;
            margin-top: 8px;
        }

        /* New status style for the user's booking */
        .user-booked {
            font-size: 14px;
            font-weight: bold;
            color: green;
            margin-top: 8px;
        }

    </style>
</head>
<body>
    <div class="navbar">
        <!-- Navigation menu -->
        <div class="menu">
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="aboutus2.html">About</a></li>
                <li><a href="contactus2.html">Contact</a></li>
                <li><a href="index.php">Logout</a></li>
                <li><p>Hello, <?php echo $rows['FNAME'] . " " . $rows['LNAME']; ?></p></li>
            </ul>
        </div>
    </div>

    <!-- White section with message -->
    <div class="white-section">
        <h2>Enjoy Your Life at Full Scale !</h2>
    </div>

    <!-- Car list section -->
    <h1 class="overview">Our Cars List</h1>
    <div class="car-container">
        <?php while ($result = mysqli_fetch_assoc($cars)) { ?>
            <div class="box <?php echo ($result['AVAILABLE'] == 'N') ? 'booked' : ''; ?>">
                <img src="images/<?php echo $result['CAR_IMG']; ?>" alt="<?php echo $result['CAR_NAME']; ?>">
                <h2><?php echo $result['CAR_NAME']; ?></h2>
                <p>Fuel Type: <?php echo $result['FUEL_TYPE']; ?></p>
                <p>Capacity: <?php echo $result['CAPACITY']; ?> people</p>
                <p>Rent Per Day: <?php echo $result['PRICE']; ?>/-</p>

                <!-- Check if the car is available and the user has booked it -->
                <?php 
                    if ($result['AVAILABLE'] == 'Y') {
                        if (in_array($result['CAR_ID'], $bookedCars)) {
                            // Car is booked by the user
                            // Get the booking status for this car and user
                            $statusSql = "SELECT BOOK_STATUS FROM booking WHERE CAR_ID = ".$result['CAR_ID']." AND EMAIL = '$value'";
                            $statusResult = mysqli_query($con, $statusSql);
                            $statusRow = mysqli_fetch_assoc($statusResult);

                            echo '<p class="user-booked">You have booked this car!</p>';
                            echo '<p class="status">Booking Status: ' . $statusRow['BOOK_STATUS'] . '</p>';
                            echo '<button class="button disabled">Not Available</button>';
                        } else {
                            // Car is available and not booked by the user
                            echo '<a href="booking.php?id=' . $result['CAR_ID'] . '" class="button">Book Now</a>';
                        }
                    } else {
                        echo '<p class="status">Booked</p>';
                        echo '<button class="button disabled">Not Available</button>';
                    }
                ?>
            </div>
        <?php } ?>
    </div>
</body>
</html>
