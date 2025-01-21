
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancel Booking</title>
</head>
<body>
<style>
    .form {
        align-content: center;
        margin-left: 350px;
        margin-top: 150px;
    }

    .hai {
        width: 200px;
        height: 40px;
        background: #ff7200;
        border: none;
        font-size: 18px;
        border-radius: 5px;
        cursor: pointer;
        color: #fff;
        margin-left: 90px;
    }

    .no {
        width: 200px;
        height: 40px;
        background: #ff7200;
        border: none;
        font-size: 18px;
        border-radius: 5px;
        cursor: pointer;
        color: #fff;
        margin-left: 100px;
    }

    .no a {
        text-decoration: none;
        color: white;
    }
</style>

<?php
    require_once('connection.php');
    session_start();

    // Check if the user is logged in and if a booking ID is set
    if (!isset($_SESSION['email']) || !isset($_SESSION['bid'])) {
        echo "<script>alert('No booking found to cancel. Redirecting to home page.');</script>";
        echo "<script>window.location.href='index.php';</script>";
        exit();
    }

    $bid = $_SESSION['bid']; // Get booking ID from the session

    // Handle cancellation
    if (isset($_POST['cancelnow'])) {
        // Prepare and execute delete query
        $stmt = $con->prepare("DELETE FROM booking WHERE BOOK_ID = ? LIMIT 1");
        $stmt->bind_param("i", $bid);

        if ($stmt->execute()) {
            echo "<script>alert('Booking cancelled successfully. Redirecting to car details page.');</script>";
            echo "<script>window.location.href='cardetails.php';</script>";
        } else {
            echo "<script>alert('Error cancelling booking. Please try again later.');</script>";
        }

        $stmt->close(); // Close the prepared statement
    }
?>

<!-- Cancel Booking Form -->
<form class="form" method="POST">
    <h1>ARE YOU SURE YOU WANT TO CANCEL YOUR BOOKING?</h1>
    <input type="submit" class="hai" value="CANCEL NOW" name="cancelnow">
    <button class="no"><a href="payment.php">GO TO PAYMENT</a></button>
</form>
</body>
</html>
