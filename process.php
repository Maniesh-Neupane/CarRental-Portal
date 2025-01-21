<?php

// Start the session to access session variables
session_start();

// Retrieve the value stored in the session with the key 'rdate'
$value = $_SESSION['rdate'];

// Display the session value
echo $value;
/**
 * process.php
 * 
 * This script handles form submissions for user registration. 
 * It performs the following actions:
 * - Retrieves and sanitizes form data to prevent SQL injection.
 * - Validates input to ensure no required fields are empty.
 * - Inserts the validated data into the 'users' database table.
 * - Displays success or error messages based on the database operation result.
 * - Manages a session to retrieve and display the 'rdate' value
 */


?>
