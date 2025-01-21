
<?php
require_once('connection.php');
session_start();

if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $pass = trim($_POST['pass']);

    if (empty($email) || empty($pass)) {
        echo '<script>alert("Please fill in all the fields.")</script>';
    } else {
        // prepared statement to avoid SQL injection
        $query = "SELECT * FROM users WHERE EMAIL = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $db_password = $row['PASSWORD']; // Password stored in the database (MD5 hashed)

            // Hash the entered password using MD5
            if (md5($pass) === $db_password) {
                // Store user email in session and redirect
                $_SESSION['email'] = $email;
                header("Location: cardetails.php");
                exit;
            } else {
                echo '<script>alert("Incorrect password. Please try again.")</script>';
            }
        } else {
            echo '<script>alert("Email not found. Please register or try again.")</script>';
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
       
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Background and layout for the page */
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

        /* Form container */
        .content {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        /* Login form box design */
        .form {
            width: 100%;
            max-width: 400px;
            background: rgba(0, 0, 0, 0.7); /* Darker background for the form */
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
            text-align: center;
        }

        /* Heading styling */
        .form h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #fff;
        }

        /* Input field styles */
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

        /* Input focus effect */
        .form input:focus {
            border: 2px solid #ff6600;
            box-shadow: 0 0 8px rgba(255, 102, 0, 0.8);
        }

        /* Submit button design */
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

        /* Hover effect on submit button */
        .form .btnn:hover {
            background-color: #e65c00;
        }

        /* Link to sign up (styled below the form) */
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
    </style>
</head>
<body>
    <div class="content">
        <div class="form">
            <h2>Login Here</h2>
            <form method="POST">
                <input type="email" name="email" placeholder="Enter Email" required>
                <input type="password" name="pass" placeholder="Enter Password" required>
                <input class="btnn" type="submit" value="Login" name="login">
            </form>
            <p class="link">Don't have an account?<br>
                <a href="register.php">Sign up</a> here</p>
        </div>
    </div>
</body>
</html>
