<?php
session_start(); // Start the session

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: index.php"); // redirect if not logged in as admin
    exit();
}

if (isset($_POST['addcar'])) {
    require_once('connection.php');

    echo "<pre>";
    print_r($_FILES['image']);
    echo "</pre>";

    $img_name = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $error = $_FILES['image']['error'];

    if ($error === 0) {
        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);

        $allowed_exs = array("jpg", "jpeg", "png", "webp", "svg");

        if (in_array($img_ex_lc, $allowed_exs)) {
            $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
            $img_upload_path = 'images/' . $new_img_name;
            move_uploaded_file($tmp_name, $img_upload_path);

            $carname = mysqli_real_escape_string($con, $_POST['carname']);
            $ftype = mysqli_real_escape_string($con, $_POST['ftype']);
            $capacity = mysqli_real_escape_string($con, $_POST['capacity']);
            $price = mysqli_real_escape_string($con, $_POST['price']);
            $available = "Y";

            $query = "INSERT INTO cars(CAR_NAME,FUEL_TYPE,CAPACITY,PRICE,CAR_IMG,AVAILABLE) 
                      VALUES('$carname','$ftype',$capacity,$price,'$new_img_name','$available')";

            $res = mysqli_query($con, $query);
            if ($res) {
                echo '<script>alert("Wow, New Car Added Successfully !!")</script>';
                echo '<script>window.location.href = "adminvehicle.php";</script>';
            }
        } else {
            echo '<script>alert("Cannot upload this type of image")</script>';
            echo '<script>window.location.href = "addcar.php";</script>';
        }
    } else {
        $em = "unknown error occurred";
        header("Location: addcar.php?error=$em");
        exit();
    }
} else {
    echo "false";
}
?>
