<?php
require_once('connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $car_id = mysqli_real_escape_string($con, $_POST['car_id']);
    $new_price = mysqli_real_escape_string($con, $_POST['new_price']);

    $update_query = "UPDATE cars SET PRICE = '$new_price' WHERE CAR_ID = '$car_id'";
    if (mysqli_query($con, $update_query)) {
        echo '<script>alert("Price updated successfully."); window.location.href="adminvehicle.php";</script>';
    } else {
        echo '<script>alert("Error updating price."); window.location.href="adminvehicle.php";</script>';
    }
}
?>
