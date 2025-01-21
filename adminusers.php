
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .hai {
            width: 100%;
            background: url("../images/carbg2.jpg") center center no-repeat;
            background-size: cover;
            height: 100vh;
            position: relative;
        }

        .navbar {
            width: 100%;
            padding: 10px 50px;
            background-color: #0066cc; /* Blue background for navbar */
            display: flex;
            justify-content: space-between; /* Space between menu items and logout */
            align-items: center;
        }

        .menu {
            display: flex;
            justify-content: space-evenly; /* Distribute menu items evenly */
            flex: 1; /* Allow the menu to take all available space */
        }

        .menu ul {
            display: flex;
            width: 100%; /* Ensure the menu spans the full width */
            justify-content: space-between; /* Spread the items evenly across the width */
            list-style: none;
            padding: 0;
        }

        .menu li {
            list-style: none;
        }

        .menu li a {
            text-decoration: none;
            color: white;
            font-weight: bold;
            font-size: 18px;
            padding: 10px 30px; /* Add padding for spacing between the links */
            transition: color 0.3s ease;
        }

        .menu li a:hover,
        .menu li a.active {
            color: #ff7200;
            background-color: #005bb5; /* Darker blue on hover */
            border-radius: 5px;
        }

        .logout-btn-container {
            margin-left: 40px; /* Adds more space between the menu items and the logout button */
        }

        .logout-btn {
            padding: 10px 20px;
            background-color:rgb(25, 15, 25);
            border: none;
            border-radius: 10px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #ff4500;
        }

        .content-table {
            width: 90%;
            margin: 30px auto;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
            border-radius: 8px;
        }

        .content-table th,
        .content-table td {
            padding: 12px 15px;
            text-align: left;
        }

        .content-table thead {
            background-color: #ff7200;
            color: white;
        }

        .content-table tbody tr:nth-of-type(even) {
            background-color: #f9f9f9;
        }

        .content-table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .content-table tbody tr:last-child {
            border-bottom: 2px solid #ff7200;
        }

        .header {
            text-align: center;
            margin-top: 50px;
            font-size: 32px;
            font-weight: bold;
            color: #333;
        }

        .delete-btn {
            padding: 8px 15px;
            background-color:rgb(255, 170, 0); /* Simpler delete button color */
            border: none;
            color: white;
            font-weight: bold;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .delete-btn:hover {
            background-color: #ff2a00;
        }
    </style>
</head>
<body>

<?php
require_once('connection.php');
$query = "SELECT * FROM users";
$queryy = mysqli_query($con, $query);
?>

<div class="hai">
    <div class="navbar">
        <div class="menu">
            <ul>
                <li><a href="adminvehicle.php" class="nav-link">Add Car</a></li>
                <li><a href="adminusers.php" class="nav-link">User Management</a></li>
                <li><a href="admindash.php" class="nav-link">Feedbacks</a></li>
                <li><a href="adminbook.php" class="nav-link">Booking Request</a></li>
            </ul>
        </div>
        <div class="logout-btn-container">
            <!-- Logout button with space to the right -->
            <button class="logout-btn"><a href="index.php" style="color: white; text-decoration: none;">LOGOUT</a></button>
        </div>
    </div>

    <div class="header">USERS</div>

    <div>
        <table class="content-table">
            <thead>
                <tr>
                    <th>NAME</th> 
                    <th>EMAIL</th>
                    <th>LICENSE NUMBER</th>
                    <th>PHONE NUMBER</th> 
                    <th>GENDER</th> 
                    <th>DELETE USER</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($res = mysqli_fetch_array($queryy)) {
                ?>
                <tr>
                    <td><?php echo $res['FNAME'] . " " . $res['LNAME']; ?></td>
                    <td><?php echo $res['EMAIL']; ?></td>
                    <td><?php echo $res['LIC_NUM']; ?></td>
                    <td><?php echo $res['PHONE_NUMBER']; ?></td>
                    <td><?php echo $res['GENDER']; ?></td>
                    <td><button class="delete-btn"><a href="deleteuser.php?id=<?php echo $res['EMAIL'] ?>" style="color: white; text-decoration: none;">DELETE USER</a></button></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    // Add active class to clicked menu item
    const menuLinks = document.querySelectorAll('.nav-link');
    menuLinks.forEach(link => {
        link.addEventListener('click', () => {
            menuLinks.forEach(link => link.classList.remove('active'));
            link.classList.add('active');
        });
    });
</script>

</body>
</html>
