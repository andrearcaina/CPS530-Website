<?php
$hostname = "localhost";
$username = "YOUR_USERNAME_HERE";
$password = "YOUR_PASSWORD_HERE";
$database = "YOUR_DATABASE_HERE";

$connect = mysqli_connect($hostname, $username, $password, $database);

function getTable($connect) {
    $sql = "SELECT * FROM Photographs";
    $sql .= " ORDER BY date_taken DESC";

    $query = mysqli_query($connect, $sql); 

    $table = "<div id='table-container'>";
    $table .= "<table border='2'>";
    $table .= "<tr>";
    $table .= "<th>Picture Number</th>";
    $table .= "<th>Subject</th>";
    $table .= "<th>Location</th>";
    $table .= "<th>Date Taken</th>";
    $table .= "<th>Picture URL</th>";
    $table .= "</tr>";

    while($row = mysqli_fetch_assoc($query)) {
        $table .= "<tr>";
        $table .= "<td>" . $row['picture_number'] . "</td>";
        $table .= "<td>" . $row['subject'] . "</td>";
        $table .= "<td>" . $row['location'] . "</td>";
        $table .= "<td>" . $row['date_taken'] . "</td>";
        $table .= "<td>" . $row['picture_url'] . "</td>";
        $table .= "</tr>";
    }

    $table .= "</table>";
    $table .= "</div>";

    return $table;
}

$table = getTable($connect);

mysqli_close($connect);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab09b</title>
    <link rel="stylesheet" href="lab09.css">
</head>
<body>
    <h2 style="text-align: center;"> Problem 2 </h2>
    <?php echo $table; ?>

    <div style="text-align: center;">
        <p><a href="lab09.php">Click here to go back to beginning form</a></p>
        <p><a href="lab09c.php">Click here to go to see Ontario (Lab09c)</a></p>
    </div>
</body>
</html>