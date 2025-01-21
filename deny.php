
<?php
require_once('connection.php');

// Validate booking ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo '<script>alert("Invalid booking ID!");</script>';
    echo '<script>window.location.href = "adminbook.php";</script>';
    exit();
}

$bookid = intval($_GET['id']);

// Fetch booking details
$sql = "SELECT * FROM booking WHERE BOOK_ID = $bookid";
$result = mysqli_query($con, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    echo '<script>alert("Booking not found!");</script>';
    echo '<script>window.location.href = "adminbook.php";</script>';
    exit();
}

$res = mysqli_fetch_assoc($result);
$car_id = $res['CAR_ID'];

// Deny the booking and mark the car as available
$query1 = "UPDATE booking SET BOOK_STATUS = 'Denied' WHERE BOOK_ID = $bookid";
$query2 = "UPDATE cars SET AVAILABLE = 'Y' WHERE CAR_ID = $car_id";

if (mysqli_query($con, $query1) && mysqli_query($con, $query2)) {
    echo '<script>alert("Booking denied successfully.");</script>';
} else {
    echo '<script>alert("Failed to deny booking.");</script>';
}

echo '<script>window.location.href = "adminbook.php";</script>';
?>
