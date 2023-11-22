<?php
$hostname = "localhost";
$username = "YOUR_USERNAME_HERE";
$password = "YOUR_PASSWORD_HERE";
$database = "YOUR_DATABASE_HERE";

$connect = mysqli_connect($hostname, $username, $password, $database);

$sql = "SELECT picture_url, location, subject FROM Photographs";
$query = mysqli_query($connect, $sql);

$imgs = "<div id='imgs'>";
$ontario = false;

while ($row = mysqli_fetch_assoc($query)) {
    $picture_url = $row['picture_url'];
    $location = $row['location'];
    $subject = $row['subject'];

    if (strpos($location, 'Ontario') !== false) {
        $ontario = true;
        $imgs .= "<div class='img-container'>";
        $imgs .= "<img class='ontario' src='$picture_url'/>";
        $imgs .= "<span class='ontario'>Subject: $subject</span>";
        $imgs .= "<span class='ontario'>Location: $location</span>";
        $imgs .= "</div>";
    }
}

$imgs .= "</div>";

mysqli_close($connect);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab09c</title>
    <link rel="stylesheet" href="lab09.css">
</head>
<body>
    <h2 style="text-align: center;"> Problem 3 </h2>

    <div>
        <?php
        if ($ontario) {
            echo $imgs;
        } else {
            echo "<p class='noOntario'>There are no Ontario photos.</p>";
        }
        ?>
    </div>

    <div style="text-align: center;">
        <p><a href="lab09.php">Click here to go back to beginning form</a></p>
        <p><a href="lab09d.php">Click here to go to another form (Lab09d)</a></p>
    </div>
</body>
</html>
