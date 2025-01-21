
<?php
require_once('connection.php');

// Start the session at the very beginning of the script
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    echo '<script>alert("No session found. Please log in again.")</script>';
    exit;
}

$email = $_SESSION['email']; // Fetch logged-in user's email

// Fetch booking data for the logged-in user
$sql = "SELECT * FROM booking WHERE EMAIL='$email' ORDER BY BOOK_ID DESC LIMIT 1";
$result = mysqli_query($con, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $booking = mysqli_fetch_assoc($result);
    $_SESSION['bid'] = $booking['BOOK_ID'];
    $price = $booking['PRICE'];
} else {
    echo '<script>alert("No booking found.")</script>';
    exit;
}

// Handle payment form submission
if (isset($_POST['pay'])) {
    // Sanitize inputs
    $cardno = mysqli_real_escape_string($con, $_POST['cardno']);
    $exp = mysqli_real_escape_string($con, $_POST['exp']);
    $cvv = mysqli_real_escape_string($con, $_POST['cvv']);

    // Validation
    if (empty($cardno) || empty($exp) || empty($cvv)) {
        echo '<script>alert("Please fill all the fields.")</script>';
    } elseif (strlen($cardno) != 16) {
        echo '<script>alert("Card number must be 16 digits.")</script>';
    } elseif (strlen($cvv) != 3) {
        echo '<script>alert("CVV must be 3 digits.")</script>';
    } else {
        $sql2 = "INSERT INTO payment (BOOK_ID, CARD_NO, EXP_DATE, CVV, PRICE) 
                 VALUES ('$booking[BOOK_ID]', '$cardno', '$exp', '$cvv', '$price')";
        if (mysqli_query($con, $sql2)) {
            header("Location: psucess.php");
            exit;
        } else {
            echo '<script>alert("Payment failed. Please try again.")</script>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.1/css/all.min.css">
    <title>Payment Form</title>
    <script type="text/javascript">
        function preventBack() {
            window.history.forward(); 
        }
        setTimeout("preventBack()", 0);
        window.onunload = function () { null };
    </script>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        /* Body Styling */
        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: orange url("images/paym.jpg") center/cover;
            overflow: hidden;
        }

        /* Card Styling */
        .card {
            margin-left: -500px;
            background: linear-gradient(
                to bottom right,
                rgba(255, 255, 255, 0.2),
                rgba(255, 255, 255, 0.05)
            );
            box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.5), -1px -1px 2px #aaa, 1px 1px 2px #555;
            backdrop-filter: blur(0.8rem);
            padding: 1.5rem;
            border-radius: 1rem;
        }

        .card__title {
            font-weight: 600;
            font-size: 2.5rem;
            color: black;
            margin: 1rem 0 1.5rem;
            text-shadow: 0 2px 2px rgba(0, 0, 0, 0.3);
        }

        .card__row {
            display: flex;
            justify-content: space-between;
            padding-bottom: 2rem;
        }

        .card__col {
            padding-right: 2rem;
        }

        .card__input {
            background: none;
            border: none;
            border-bottom: dashed 0.2rem rgba(255, 255, 255, 0.15);
            font-size: 1.2rem;
            color: #fff;
            text-shadow: 0 3px 2px rgba(0, 0, 0, 0.3);
        }

        .card__input--large {
            font-size: 2rem;
        }

        .card__input::placeholder {
            color: rgba(255, 255, 255, 1);
            text-shadow: none;
        }

        .card__input:focus {
            outline: none;
            border-color: rgba(255, 255, 255, 0.6);
        }

        .pay {
            width: 200px;
            background: #ff7200;
            border: none;
            height: 40px;
            font-size: 18px;
            border-radius: 5px;
            cursor: pointer;
            color: white;
            margin-left: 100px;
        }

        .btn {
            width: 200px;
            background: #ff7200;
            border: none;
            height: 40px;
            font-size: 18px;
            border-radius: 5px;
            cursor: pointer;
            color: white;
        }

        .btn a {
            text-decoration: none;
            color: white;
        }

        .payment {
            margin-top: -550px;
            margin-left: 1000px;
        }
    </style>
</head>
<body>
    <h2 class="payment">TOTAL PAYMENT: <a><?php echo $price; ?>/-</a></h2>

    <div class="card">
        <form method="POST">
            <h1 class="card__title">Enter Payment Information</h1>
            <div class="card__row">
                <div class="card__col">
                    <label class="card__label">Card Number</label>
                    <input
                        type="text"
                        class="card__input card__input--large"
                        placeholder="xxxx-xxxx-xxxx-xxxx"
                        required
                        name="cardno"
                        maxlength="16"
                    />
                </div>
            </div>
            <div class="card__row">
                <div class="card__col">
                    <label class="card__label">Expiry Date</label>
                    <input
                        type="text"
                        class="card__input"
                        placeholder="xx/xx"
                        required
                        name="exp"
                        maxlength="5"
                    />
                </div>
                <div class="card__col">
                    <label class="card__label">CCV</label>
                    <input
                        type="password"
                        class="card__input"
                        placeholder="xxx"
                        required
                        name="cvv"
                        maxlength="3"
                    />
                </div>
            </div>
            <input type="submit" value="PAY NOW" class="pay" name="pay">
            <button class="btn"><a href="cancelbooking.php">CANCEL</a></button>
        </form>
    </div>
</body>
</html>
