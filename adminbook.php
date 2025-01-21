
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Bookings</title>
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
            background-color: #0066cc;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .menu {
            display: flex;
            justify-content: space-evenly;
            flex: 1;
        }

        .menu ul {
            display: flex;
            width: 100%;
            justify-content: space-between;
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
            padding: 10px 30px;
            transition: color 0.3s ease;
        }

        .menu li a:hover,
        .menu li a.active {
            color: #ff7200;
            background-color: #005bb5;
            border-radius: 5px;
        }

        .logout-btn-container {
            margin-left: 40px;
        }

        .logout-btn {
            padding: 10px 20px;
            background-color: rgb(25, 15, 25);
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

        .action-link {
            color: #007BFF;
            font-weight: bold;
            text-decoration: none;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .action-link:hover {
            color: #FFC107;
        }
    </style>
</head>
<body>

<?php
require_once('connection.php');
$query = "SELECT booking.*, cars.CAR_NAME FROM booking 
          JOIN cars ON booking.CAR_ID = cars.CAR_ID
          ORDER BY BOOK_ID DESC";
$queryy = mysqli_query($con, $query);
?>

<div class="hai">
    <div class="navbar">
        <div class="menu">
            <ul>
                <li><a href="adminvehicle.php" class="nav-link">Add Car</a></li>
                <li><a href="adminusers.php" class="nav-link">User Management</a></li>
                <li><a href="admindash.php" class="nav-link">Feedbacks</a></li>
                <li><a href="adminbook.php" class="nav-link active">Booking Request</a></li>
            </ul>
        </div>
        <div class="logout-btn-container">
            <button class="logout-btn"><a href="index.php" style="color: white; text-decoration: none;">LOGOUT</a></button>
        </div>
    </div>

    <div class="header">BOOKINGS</div>

    <div>
        <table class="content-table">
            <thead>
                <tr>
                    <th>CAR NAME</th>
                    <th>EMAIL</th>
                    <th>BOOK PLACE</th>
                    <th>BOOK DATE</th>
                    <th>DURATION</th>
                    <th>PHONE NUMBER</th>
                    <th>DESTINATION</th>
                    <th>RETURN DATE</th>
                    <th>BOOKING STATUS</th>
                    <th>APPROVE/DENY</th>
                    <th>CAR RETURNED</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($res = mysqli_fetch_array($queryy)) { ?>
                    <tr>
                        <td><?php echo $res['CAR_NAME']; ?></td>
                        <td><?php echo $res['EMAIL']; ?></td>
                        <td><?php echo $res['BOOK_PLACE']; ?></td>
                        <td><?php echo $res['BOOK_DATE']; ?></td>
                        <td><?php echo $res['DURATION']; ?></td>
                        <td><?php echo $res['PHONE_NUMBER']; ?></td>
                        <td><?php echo $res['DESTINATION']; ?></td>
                        <td><?php echo $res['RETURN_DATE']; ?></td>
                        <td><?php echo $res['BOOK_STATUS']; ?></td>
                        <td>
                            <a class="action-link" href="approve.php?id=<?php echo $res['BOOK_ID']; ?>">Approve</a> /
                            <a class="action-link" href="deny.php?id=<?php echo $res['BOOK_ID']; ?>">Deny</a>
                        </td>
                        <td><a class="action-link" href="adminreturn.php?id=<?php echo $res['CAR_ID']; ?>&bookid=<?php echo $res['BOOK_ID']; ?>">Returned</a></td>
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
