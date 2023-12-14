<?php
@include 'config.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

if (isset($_POST['submit'])) {
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = md5($_POST['password']);
    $cpassword = md5($_POST['cpassword']);

    // Check if the user already exists
    $select = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $error[] = 'User already exists!';
		var_dump($error);
    } else {
        // Check if passwords match
        if ($password != $cpassword) {
            $error[] = 'Passwords do not match!';
			var_dump($error);
        } else {
            // Insert user into the database
            $insert = "INSERT INTO users (first_name, last_name, email, password) VALUES ('$first_name', '$last_name', '$email', '$password')";
            mysqli_query($conn, $insert);
            header('location: http://localhost/GUVI/login.html');
        }
    }
}
?>