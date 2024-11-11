<?php

session_start();
// session start here...
// get all 3 strings from the form (and scrub w/ validation function)
include_once 'validate.php';
$user = test_input($_POST['user']);
$pwd = test_input($_POST['pwd']);
$repeat = test_input($_POST['repeat']);

// make sure that the two password values match!

if ($pwd != $repeat) {
    header("Location:index.php");
}

// create the password_hash using the PASSWORD_DEFAULT argument

$hashPass = password_hash($pwd, PASSWORD_DEFAULT);

// login to the database

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "softball";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sqlCheck = "SELECT username FROM users WHERE username = '$user'";
$result = $conn->query($sqlCheck);

if ($result->num_rows > 0) {
    die("Invalid username");
}

$sqlAdd = "INSERT INTO users (username, password) VALUES ('$user', '$hashPass')";

if ($conn->query($sqlAdd)) {
    header("Location:index.php");
} else {
    echo "Error";
}

$conn->close();
header("location:index.php");

// make sure that the new user is not already in the database

// insert username and password hash into db (put the username in the session
// or make them login)

