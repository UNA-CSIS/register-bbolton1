<?php
session_start();
// start session

// login to the softball database

// select password from users where username = <what the user typed in>

// if no rows, then username is not valid (but don't tell Mallory) just send
// her back to the login

// otherwise, password_verify(password from form, password from db)

// if good, put username in session, otherwise send back to login

include_once 'validate.php';
$userName = test_input($_POST['user']);
$userPassword = test_input($_POST['pwd']);

if (strlen($userName) < 1 || strlen($userPassword) < 1) {
    header("location:index.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "softball";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT password FROM users WHERE username = '$userName'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    if ($row = $result->fetch_assoc()) {
        $verified = password_verify( $userPassword, $row['password']);
        if ($verified) {
            $_SESSION['user'] = $userName;
        } else {
            header("Location:index.php");
        }
    }
} else {
    header("Location:index.php");
}
$conn->close();
header("location:index.php");

