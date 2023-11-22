<?php
$hostname = "localhost";
$username = "YOUR_USERNAME_HERE";
$password = "YOUR_PASSWORD_HERE";
$database = "YOUR_DATABASE_HERE";

$connect = mysqli_connect($hostname, $username, $password, $database);

$sql = "SELECT DISTINCT location AS location FROM Photographs";
$locationResult = mysqli_query($connect, $sql);

$sql = "SELECT DISTINCT YEAR(date_taken) AS year FROM Photographs";
$dateResult = mysqli_query($connect, $sql);

$location = '';
$year = '';

if(isset($_POST['location']) && isset($_POST['year'])) {
    $location = $_POST['location'];
    $year = $_POST['year'];
} 

$sql = "SELECT * FROM Photographs WHERE ";
$conditions = [];

if (!empty($location)) {
    $conditions[] = "location = '$location'";
}

if (!empty($year)) {
    $conditions[] = "YEAR(date_taken) = '$year'";
}

$sql .= implode(" AND ", $conditions);

$query = mysqli_query($connect, $sql);

$pictures = "<div id='imgs'>";
while ($row = mysqli_fetch_assoc($query)) {
    $picture_url = $row['picture_url'];
    $subject = $row['subject'];
    $location = $row['location'];
    $date_taken = $row['date_taken'];

    $pictures .= "<div class='img-container'>";
    $pictures .= "<img class='image' src='$picture_url' alt='$subject'/>";
    $pictures .= "<p><strong>Subject:</strong> $subject</p>";
    $pictures .= "<p><strong>Location:</strong> $location</p>";
    $pictures .= "<p><strong>Date Taken:</strong> $date_taken</p>";
    $pictures .= "</div>";
}
$pictures .= "</div>";

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
    <div> <?php echo $pictures; ?> </div>

    <div style="text-align: center;">
        <p><a href="lab09d.php">Click here to go back to the form</a></p>
        <p><a href="lab09e.php">Click here to go randomizer (Lab09e)</a></p>
    </div>
</body>
</html>
