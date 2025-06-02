<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php"); // Redirect to login page
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMINISTRATOR</title>
    <style>
        /* [YOUR ORIGINAL CSS - UNCHANGED] */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background: white;
            background-size: cover;
            background-position: center;
            color: #333;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #007BFF;
            padding: 14px 20px;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .menu ul {
            display: flex;
            list-style: none;
        }
        .menu ul li {
            margin: 0 79px;
        }
        .menu ul li a {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            transition: color 0.3s;
            padding: 10px 15px;
        }
        .menu ul li a:hover {
            color: #FFC107;
        }
        .nn {
            background: #000;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            color: #fff;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.3s;
        }
        .nn:hover {
            background: #fff;
            color: #007BFF;
        }
        .nn a {
            color: inherit;
            text-decoration: none;
        }
        .header {
            text-align: center;
            margin: 20px 0;
            font-size: 32px;
            color: #FFC107;
        }
        .add {
            display: block;
            margin: 20px auto;
            width: 200px;
            height: 50px;
            background: #FF7200;
            color: white;
            border: none;
            font-size: 18px;
            font-weight: bold;
            border-radius: 10px;
            text-align: center;
            line-height: 50px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .add a {
            text-decoration: none;
            color: white;
            display: block;
        }
        .add:hover {
            background: #E05E00;
        }
        .table-container {
            overflow-x: auto;
            margin: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1000px;
            background: #fff;
            color: #333;
            border-radius: 10px;
            overflow: hidden;
        }
        thead {
            background-color: #ff7200;
            color: white;
        }
        th, td {
            text-align: left;
            padding: 12px;
        }
        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tbody tr:nth-child(odd) {
            background-color: #ffffff;
        }
        tbody tr:hover {
            background-color: rgba(0, 123, 255, 0.1);
        }
        td, th {
            border: 1px solid #ddd;
        }
        td a {
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
        }
        td a:hover {
            text-decoration: underline;
        }
        .update-price-form {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .update-price-input {
            width: 100px;
            padding: 5px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .update-price-btn {
            padding: 5px 10px;
            background: #007BFF;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
            font-size: 14px;
            transition: background 0.3s;
        }
        .update-price-btn:hover {
            background: #0056b3;
        }
        .delete-btn {
            padding: 5px 10px;
            background:rgb(34, 189, 255);
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
            font-size: 14px;
            transition: background 0.3s;
        }
        .delete-btn:hover {
            background:rgb(25, 128, 230);
        }
        .delete-btn a {
            color: white;
            text-decoration: none;
        }
    </style>
</head>
<body>

    <div class="navbar">
        <div class="menu">
            <ul>
                <li><a href="adminvehicle.php">Add Car</a></li>
                <li><a href="adminusers.php">User Management</a></li>
                <li><a href="admindash.php">Feedbacks</a></li>
                <li><a href="adminbook.php">Booking Request</a></li>
                <li>
                    <form action="logout.php" method="POST" style="display:inline;">
                        <button type="submit" class="nn">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>

    <h1 class="header">Car Management</h1>

    <button class="add"><a href="addcar.php">+ ADD CAR</a></button>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>CAR ID</th>
                    <th>CAR NAME</th>
                    <th>FUEL TYPE</th>
                    <th>CAPACITY</th>
                    <th>PRICE</th>
                    <th>AVAILABLE</th>
                    <th>UPDATE PRICE</th>
                    <th>DELETE</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once('connection.php');
                $query = "SELECT * FROM cars";
                $queryy = mysqli_query($con, $query);
                while ($res = mysqli_fetch_array($queryy)) { ?>
                    <tr>
                        <td><?php echo $res['CAR_ID']; ?></td>
                        <td><?php echo $res['CAR_NAME']; ?></td>
                        <td><?php echo $res['FUEL_TYPE']; ?></td>
                        <td><?php echo $res['CAPACITY']; ?></td>
                        <td><?php echo $res['PRICE']; ?></td>
                        <td><?php echo ($res['AVAILABLE'] == 'Y') ? 'YES' : 'NO'; ?></td>
                        <td>
                            <form class="update-price-form" method="POST" action="updateprice.php">
                                <input type="hidden" name="car_id" value="<?php echo $res['CAR_ID']; ?>">
                                <input type="number" name="new_price" class="update-price-input" placeholder="New Price" required>
                                <button type="submit" class="update-price-btn">Update</button>
                            </form>
                        </td>
                        <td>
                            <button class="delete-btn"><a href="deletecar.php?id=<?php echo $res['CAR_ID']; ?>">DELETE CAR</a></button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</body>
</html>
