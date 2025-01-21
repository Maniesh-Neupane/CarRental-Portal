<?php
require_once('connection.php');

// Validate booking ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo '<script>alert("Invalid booking ID!");</script>';
    echo '<script>window.location.href = "adminbook.php";</script>';
    exit();
}

$bookid = intval($_GET['id']);

// Fetch booking and car details
$sql = "SELECT * FROM booking WHERE BOOK_ID = $bookid";
$result = mysqli_query($con, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    echo '<script>alert("Booking not found!");</script>';
    echo '<script>window.location.href = "adminbook.php";</script>';
    exit();
}

$res = mysqli_fetch_assoc($result);
$car_id = $res['CAR_ID'];

// Fetch car details
$sql2 = "SELECT * FROM cars WHERE CAR_ID = $car_id";
$carres = mysqli_query($con, $sql2);

if (!$carres || mysqli_num_rows($carres) == 0) {
    echo '<script>alert("Car not found!");</script>';
    echo '<script>window.location.href = "adminbook.php";</script>';
    exit();
}

$carresult = mysqli_fetch_assoc($carres);

if ($carresult['AVAILABLE'] === 'Y') {
    // Approve the booking and mark car as booked
    $query1 = "UPDATE booking SET BOOK_STATUS = 'APPROVED' WHERE BOOK_ID = $bookid";
    $query2 = "UPDATE cars SET AVAILABLE = 'N' WHERE CAR_ID = $car_id";

    if (mysqli_query($con, $query1) && mysqli_query($con, $query2)) {
        echo '<script>alert("Booking approved successfully.");</script>';
    } else {
        echo '<script>alert("Failed to approve booking.");</script>';
    }
} else {
    echo '<script>alert("Car is not available.");</script>';
}

echo '<script>window.location.href = "adminbook.php";</script>';
?>
