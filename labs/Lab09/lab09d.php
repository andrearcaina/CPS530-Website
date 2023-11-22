<?php
$hostname = "localhost";
$username = "YOUR_USERNAME_HERE";
$password = "YOUR_PASSWORD_HERE";
$database = "YOUR_DATABASE_HERE";

$connect = mysqli_connect($hostname, $username, $password, $database);

$sql = "SELECT DISTINCT location FROM Photographs";
$locationResult = mysqli_query($connect, $sql);

$sql = "SELECT DISTINCT YEAR(date_taken) AS year FROM Photographs";
$dateResult = mysqli_query($connect, $sql);

mysqli_close($connect);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab09d</title>
    <link rel="stylesheet" href="lab09.css">
</head>
<body>
    <h2 style="text-align: center;"> Problem 4 </h2>

    <form action="lab09d_sql.php" method="post">
        <label for="location">Select Location:</label>
        <select name="location" id="location" required>
            <option value="">Locations</option>
            <?php
            while ($row = mysqli_fetch_assoc($locationResult)) {
                echo "<option value='" . $row['location'] . "'>" . $row['location'] . "</option>";
            }
            ?>
        </select>

        <label for="year">Select Year:</label>
        <select name="year" id="year" required>
            <option value="">Years</option>
            <?php
            while ($row = mysqli_fetch_assoc($dateResult)) {
                echo "<option value='" . $row['year'] . "'>" . $row['year'] . "</option>";
            }
            ?>
        </select>

        <input type="submit" value="Search">
    </form>

    <div style="text-align: center;">
        <p><a href="lab09.php">Click here to go back to beginning form</a></p>
        <p><a href="lab09e.php">Click here to go to randomizer (Lab09e)</a></p>
    </div>
</body>
</html>