<?php
session_start();

if (isset($_SESSION['user'])) {
    $username = $_SESSION['user'];
    echo "Welcome $username!";
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form action="authenticate.php" method="POST">
            Username: <input type="text" name="user"><br>
            Password: <input type="password" name="pwd"><br>
            <input type="submit">
        </form>
        <a href="register.php">Register a new login</a>
        <p>
        <a href="games.php">UNA NCAA Championship Season</a>
    </body>
</html>
