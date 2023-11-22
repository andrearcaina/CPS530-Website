<?php
$hostname = "localhost";
$username = "YOUR_USERNAME_HERE";
$password = "YOUR_PASSWORD_HERE";
$database = "YOUR_DATABASE_HERE";

$connect = mysqli_connect($hostname, $username, $password, $database);

$sql = "SELECT * FROM Photographs ORDER BY RAND() LIMIT 1";
$query = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($query);
$randomImage = $row['picture_url']; 

$sql = "SELECT COUNT(*) AS total_images FROM Photographs";
$query = mysqli_query($connect, $sql);
$count = mysqli_fetch_assoc($query);
$totalImages = $count ? $count['total_images'] : 0;

$subject = $row['subject'];

$caption = '';

if ($subject == 'Mannequins') {
    $caption = 'Spot the difference!';
} else if ($subject == 'Sagrada Familia') {
    $caption = 'La Familia!';
} else if ($subject == 'Cascada Monumental') {
    $caption = 'Too many photobombers...';
} else if ($subject == 'Sea Cliff') {
    $caption = 'The views 🤩';
} else if ($subject == 'Mountains') {
    $caption = 'I want to live here.';
} else if ($subject == 'Leaning Tower') {
    $caption = 'Are we tilted, or is it falling?';
} else if ($subject == 'Colosseum') {
    $caption = 'WE ARE SPA- wait wrong place';
} else if ($subject == 'Trevi Fountain') {
    $caption = 'Wow. This place was crowded.';
} else if ($subject == 'Painting') {
    $caption = 'ROARRRRR';
} else if ($subject == 'Statue') {
    $caption = 'tbh, idk y i took the pic';
} else if ($subject == 'Rialto Bridge') {
    $caption = 'Venice is stunning!';
} else if ($subject == 'BBQ Food') {
    $caption = 'BBQ with the fam!';
} else {
    $caption = $subject;
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab09e</title>
    <link rel="stylesheet" href="lab09.css">
</head>
<body>
    
    <div id="randomImage"> 
        <img id="rand" src="<?php echo $randomImage; ?>" alt="Random Image">
    </div>

    <p class='caption'>Caption: <?php echo $caption ?></p>
    
    <p class='caption'>Total Images in Database: <?php echo $totalImages; ?></p>

    <div style="text-align: center;">
        <p><a href="lab09d.php">Click here to go back to beginning form</a></p>
        <p><a href="https://www.cs.ryerson.ca/~aarcaina/">Click here to go back to home</a></p>
    </div>
</body>
</html>