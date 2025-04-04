
<?php
    require_once('connection.php');
    session_start();

    // Check if the user is logged in
    if (!isset($_SESSION['email'])) {
        header("Location: index.php"); // Redirect to the index page if not logged in
        exit();
    }

    // Get the car ID and detail
    $carid = $_GET['id'];
    $sql = "SELECT * FROM cars WHERE CAR_ID='$carid'";
    $cname = mysqli_query($con, $sql);
    $email = mysqli_fetch_assoc($cname);
    
    // Get the user detail
    $value = $_SESSION['email'];
    $sql = "SELECT * FROM users WHERE EMAIL='$value'";
    $name = mysqli_query($con, $sql);
    $rows = mysqli_fetch_assoc($name);
    $uemail = $rows['EMAIL'];
    $carprice = $email['PRICE'];

    // Handle booking form submission
    if (isset($_POST['book'])) {
        $bplace = mysqli_real_escape_string($con, $_POST['place']);
        $bdate = date('Y-m-d', strtotime($_POST['date']));
        $dur = mysqli_real_escape_string($con, $_POST['dur']);
        $phno = mysqli_real_escape_string($con, $_POST['ph']);
        $des = mysqli_real_escape_string($con, $_POST['des']);
        $rdate = date('Y-m-d', strtotime($_POST['rdate']));
        
        if (empty($bplace) || empty($bdate) || empty($dur) || empty($phno) || empty($des) || empty($rdate)) {
            echo '<script>alert("Please fill all fields")</script>';
        } else {
            if ($bdate < $rdate) {
                $price = ($dur * $carprice);
                $sql = "INSERT INTO booking (CAR_ID, EMAIL, BOOK_PLACE, BOOK_DATE, DURATION, PHONE_NUMBER, DESTINATION, PRICE, RETURN_DATE) 
                        VALUES ($carid, '$uemail', '$bplace', '$bdate', $dur, $phno, '$des', $price, '$rdate')";
                $result = mysqli_query($con, $sql);

                if ($result) {
                    $_SESSION['email'] = $uemail;
                    header("Location: payment.php");
                } else {
                    echo '<script>alert("Please check the connection")</script>';
                }
            } else {
                echo '<script>alert("Please enter a correct return date")</script>';
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAR BOOKING</title>

    <script type="text/javascript">
        function preventBack() {
            window.history.forward();
        }
        setTimeout("preventBack()", 0);
        window.onunload = function () { null };
    </script>
</head>
<body background="images/bg.jpg">

<style>
    
    /* CSS remains unchanged */
    * {
        margin: 0;
        padding: 0;
    }

    div.main {
        width: 400px;
        margin: 100px auto 0px auto;
    }

    .btnn {
        width: 240px;
        height: 40px;
        background: #ff7200;
        border: none;
        margin-top: 30px;
        margin-left: 30px;
        font-size: 18px;
        border-radius: 10px;
        cursor: pointer;
        color: #fff;
        transition: 0.4s ease;
    }

    .btnn:hover {
        background: #fff;
        color: #ff7200;
    }

    h2 {
        text-align: center;
        padding: 20px;
        font-family: sans-serif;
    }

    div.register {
        background-color: rgba(0, 0, 0, 0.6);
        width: 100%;
        font-size: 18px;
        border-radius: 10px;
        border: 1px solid rgba(255, 255, 255, 0.3);
        box-shadow: 2px 2px 15px rgba(0, 0, 0, 0.3);
        color: #fff;
    }

    form#register {
        margin: 40px;
    }

    label {
        font-family: sans-serif;
        font-size: 18px;
        font-style: italic;
    }

    input {
        width: 300px;
        border: 1px solid #ddd;
        border-radius: 3px;
        outline: 0;
        padding: 7px;
        background-color: #fff;
        box-shadow: inset 1px 1px 5px rgba(0, 0, 0, 0.3);
    }
</style>

<div class="main">
    <div class="register">
        <h2>BOOKING</h2>
        <form id="register" method="POST">
            <h2>CAR NAME: <?php echo $email['CAR_NAME'] ?></h2>
            <label>BOOKING PLACE:</label><br>
            <input type="text" name="place" id="place" placeholder="Enter Your Destination"><br><br>

            <label>BOOKING DATE:</label><br>
            <input type="date" name="date" id="datefield" placeholder="Enter Booking Date"><br><br>

            <label>DURATION:</label><br>
            <input type="number" name="dur" min="1" max="30" id="duration" placeholder="Enter Rent Period (in days)"><br><br>

            <label>PHONE NUMBER:</label><br>
            <input type="tel" name="ph" maxlength="10" id="phone" placeholder="Enter Your Phone Number"><br><br>
            
            <label>DESTINATION:</label><br>
            <input type="text" name="des" id="destination" placeholder="Enter Your Destination"><br><br>

            <label>RETURN DATE:</label><br>
            <input type="date" name="rdate" id="dfield" placeholder="Enter Return Date"><br><br>
            
            <input type="submit" class="btnn" value="BOOK" name="book">
        </form>
    </div>
</div>

<script>
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; // January is 0!
    var yyyy = today.getFullYear();
    if (dd < 10) {
        dd = '0' + dd;
    }
    if (mm < 10) {
        mm = '0' + mm;
    }

    // Today's date
    var minDate = yyyy + '-' + mm + '-' + dd;

    // 6 months from today
    var sixMonthsLater = new Date(today.setMonth(today.getMonth() + 6));
    var ddSix = sixMonthsLater.getDate();
    var mmSix = sixMonthsLater.getMonth() + 1;
    var yyyySix = sixMonthsLater.getFullYear();
    if (ddSix < 10) {
        ddSix = '0' + ddSix;
    }
    if (mmSix < 10) {
        mmSix = '0' + mmSix;
    }
    var maxDate = yyyySix + '-' + mmSix + '-' + ddSix;

    document.getElementById("datefield").setAttribute("min", minDate);
    document.getElementById("datefield").setAttribute("max", maxDate);

    document.getElementById("dfield").setAttribute("min", minDate);
</script>

</body>
</html>
