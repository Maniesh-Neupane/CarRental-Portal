
<?php
require_once('connection.php');
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fname = mysqli_real_escape_string($con, $_POST['firstname']);
    $lname = mysqli_real_escape_string($con, $_POST['lastname']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $lic = mysqli_real_escape_string($con, $_POST['license']);
    $ph = mysqli_real_escape_string($con, $_POST['phone']);
    $pass = mysqli_real_escape_string($con, $_POST['password']);
    $cpass = mysqli_real_escape_string($con, $_POST['cpass']);
    $gender = mysqli_real_escape_string($con, $_POST['gender']);
    $Pass = md5($pass);

    // Server-side validation
    if (empty($fname) || empty($lname) || empty($email) || empty($lic) || empty($ph) || empty($pass) || empty($gender)) {
        $errors[] = "Please fill in all fields.";
    }

    // Validate first name and last name (min length 3 and only alphabetic characters)
    if (strlen($fname) < 3 || !preg_match("/^[a-zA-Z]+$/", $fname)) {
        $errors[] = "First name must be at least 3 characters and contain only letters.";
    }

    if (strlen($lname) < 3 || !preg_match("/^[a-zA-Z]+$/", $lname)) {
        $errors[] = "Last name must be at least 3 characters and contain only letters.";
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    // Reject numeric email addresses like '1234@1234.com'
    if (preg_match("/^[0-9]+@[0-9]+\.[a-zA-Z]{2,}$/", $email)) {
        $errors[] = "Numeric email addresses like '1234@1234.com' are not allowed.";
    }

    // Validate phone number length (should be exactly 10 digits)
    if (strlen($ph) != 10) {
        $errors[] = "Phone number must be exactly 10 digits.";
    }

    // Validate password (minimum length 8, must include an uppercase, number, and special character)
    if (strlen($pass) < 8 || !preg_match("/[A-Z]/", $pass) || !preg_match("/[0-9]/", $pass) || !preg_match("/[\W_]/", $pass)) {
        $errors[] = "Password must be at least 8 characters long, include one uppercase letter, one number, and one special character.";
    }

    // Check if passwords match
    if ($pass !== $cpass) {
        $errors[] = "Passwords do not match.";
    }

    if (empty($errors)) {
        $sql2 = "SELECT * FROM users WHERE EMAIL = '$email'";
        $res = mysqli_query($con, $sql2);
        if (mysqli_num_rows($res) > 0) {
            $errors[] = "Email already exists!";
        } else {
            $sql = "INSERT INTO users (FNAME, LNAME, EMAIL, LIC_NUM, PHONE_NUMBER, PASSWORD, GENDER) 
                    VALUES ('$fname', '$lname', '$email', '$lic', '$ph', '$Pass', '$gender')";
            if (mysqli_query($con, $sql)) {
                echo '<script>alert("Registration successful! Please log in.")</script>';
                echo '<script> window.location.href = "index.php";</script>';
            } else {
                $errors[] = "Error! Please check your connection.";
            }
        }
    }

    // Display errors
    foreach ($errors as $error) {
        echo '<div class="error">' . htmlspecialchars($error) . '</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration - Join Us!</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: url("images/paym.jpg") no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
        }

        .content {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .form {
            width: 100%;
            max-width: 400px;
            background: rgba(0, 0, 0, 0.7);
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
            text-align: center;
        }

        .form h2 {
            font-size: 24px;
            margin-bottom: 10px;
            color: #fff;
        }

        .form input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            background-color: #333;
            color: #fff;
            font-size: 16px;
            outline: none;
            transition: all 0.3s ease;
        }

        .form input:focus {
            border: 2px solid #ff6600;
            box-shadow: 0 0 8px rgba(255, 102, 0, 0.8);
        }

        .form .btnn {
            width: 100%;
            padding: 14px;
            border: none;
            background-color: #ff6600;
            color: white;
            font-size: 18px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .form .btnn:hover {
            background-color: #e65c00;
        }

        .form .link {
            margin-top: 20px;
            font-size: 14px;
            color: #ddd;
        }

        .form .link a {
            color: #ff6600;
            text-decoration: none;
        }

        .form .link a:hover {
            text-decoration: underline;
        }

        .error {
            color: red;
            font-size: 12px;
            margin-top: 10px;
        }

        .gender-options {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            font-size: 16px;
            padding: 10px 0;
        }

        .gender-options label {
            display: flex;
            align-items: center;
            font-size: 14px;
            cursor: pointer;
        }

        .gender-options input {
            margin-right: 8px;
        }

    </style>
</head>
<body>

<div class="content">
    <div class="form">
        <h2>Register Here</h2>
        <form action="register.php" method="POST" name="regForm" onsubmit="return validateForm()">
            <input type="text" name="firstname" placeholder="First Name" required>
            <input type="text" name="lastname" placeholder="Last Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="license" placeholder="License Number" required>
            <input type="tel" name="phone" maxlength="10" placeholder="Phone Number" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="cpass" placeholder="Confirm Password" required>

            <div class="gender-options">
                <label><input type="radio" name="gender" value="male" required> Male</label>
                <label><input type="radio" name="gender" value="female" required> Female</label>
            </div>

            <input type="submit" class="btnn" value="Register">
        </form>
        <div class="link">
            <p>Already have an account? <a href="login.php">Login</a></p>
        </div>
    </div>
</div>

<script>
    function validateForm() {
        const fname = document.forms["regForm"]["firstname"].value;
        const lname = document.forms["regForm"]["lastname"].value;

        const nameRegex = /^[a-zA-Z]+$/;

        if (!nameRegex.test(fname)) {
            alert("First name must contain only letters.");
            return false;
        }

        if (!nameRegex.test(lname)) {
            alert("Last name must contain only letters.");
            return false;
        }

        const email = document.forms["regForm"]["email"].value;
        const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        const numericEmailRegex = /^[0-9]+@[0-9]+\.[a-zA-Z]{2,}$/;

        if (!emailRegex.test(email)) {
            alert("Please enter a valid email address.");
            return false;
        }

        if (numericEmailRegex.test(email)) {
            alert("Numeric email addresses like '1234@1234.com' are not allowed.");
            return false;
        }

        return true;
    }
</script>

</body>
</html>
