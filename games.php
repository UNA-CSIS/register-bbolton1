<?php
session_start();

if (isset($_SESSION['user'])) {
    $username = $_SESSION['user'];
} else {
    header("location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "softball";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT opponent, site, result FROM games";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "Opponent: " . $row["opponent"] . " - Location: " . $row["site"] . " - Result: " . $row["result"] . "<br><br>";
            }
        } else {
            echo "0 results";
        }
        $conn->close();
        ?>
        
        <a href="index.php">Return to main page</a>
    </body>
</html>
