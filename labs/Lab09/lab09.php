<?php
$hostname = "localhost";
$username = "YOUR_USERNAME_HERE";
$password = "YOUR_PASSWORD_HERE";
$database = "YOUR_DATABASE_HERE";

$connect = mysqli_connect($hostname, $username, $password, $database);

if($connect){ 
    echo "<h2 style='text-align: center; margin-top: 10px;'> Problem 1 </h2>";
    echo "<p style='text-align: center; font-size: 1.6rem; font-weight: bold;'> Connection established successfully: '$database' selected </p>"; 
}
else{ echo "Connection failed"; }

$sql = "CREATE TABLE IF NOT EXISTS Photographs (
    picture_number INT AUTO_INCREMENT PRIMARY KEY NOT NULL, 
    subject VARCHAR(255) NOT NULL,
    location VARCHAR(255) NOT NULL,
    date_taken DATE NOT NULL,
    picture_url VARCHAR(500) NOT NULL
);";
    
$created = mysqli_query($connect, $sql);

$img_url = 'https://www.cs.ryerson.ca/~aarcaina/images';

$sql = "INSERT INTO Photographs (picture_number, subject, location, date_taken, picture_url)
VALUES ('1', 'Mannequins', 'Koper, Slovenia', '2023-08-22', 'images/img1.jpg');";

$sql .= "INSERT INTO Photographs (picture_number, subject, location, date_taken, picture_url)
VALUES ('2', 'Statue', 'Venice, Italy', '2023-08-21', 'images/img2.jpg');";

$sql .= "INSERT INTO Photographs (picture_number, subject, location, date_taken, picture_url)
VALUES ('3','Colosseum', 'Rome, Italy', '2023-08-25', 'images/img3.jpg');";

$sql .= "INSERT INTO Photographs (picture_number, subject, location, date_taken, picture_url)
VALUES ('4','Leaning Tower', 'Pisa, France', '2023-08-26', 'images/img4.jpg');";

$sql .= "INSERT INTO Photographs (picture_number, subject, location, date_taken, picture_url)
VALUES ('5','Trevi Fountain', 'Rome, Italy', '2023-08-25', 'images/img5.jpg');";

$sql .= "INSERT INTO Photographs (picture_number, subject, location, date_taken, picture_url)
VALUES ('6','Cascada Monumental', 'Barcelona, Spain', '2023-08-29', 'images/img6.jpg');";

$sql .= "INSERT INTO Photographs (picture_number, subject, location, date_taken, picture_url)
VALUES ('7','Mountains', 'Montserrat, Spain', '2023-08-28', 'images/img7.jpg');";

$sql .= "INSERT INTO Photographs (picture_number, subject, location, date_taken, picture_url)
VALUES ('8','Sea Cliff', 'Costa Brava, Spain', '2023-08-29', 'images/img8.jpg');";

$sql .= "INSERT INTO Photographs (picture_number, subject, location, date_taken, picture_url)
VALUES ('9','Painting', 'Koper, Slovenia', '2023-08-22', 'images/img9.jpg');";

$sql .= "INSERT INTO Photographs (picture_number, subject, location, date_taken, picture_url)
VALUES ('10','Sagrada Familia', 'Barcelona, Spain', '2023-08-30', 'images/img10.jpg');";

$sql .= "INSERT INTO Photographs (picture_number, subject, location, date_taken, picture_url)
VALUES ('11','Rialto Bridge', 'Venice, Italy', '2023-08-21', 'images/img11.jpg');";

$sql .= "INSERT INTO Photographs (picture_number, subject, location, date_taken, picture_url)
VALUES ('12','BBQ Food', 'Markham, Ontario', '2023-05-21', 'images/img12.jpg');";

mysqli_multi_query($connect, $sql);

mysqli_close($connect);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab09</title>
    <link rel="stylesheet" href="lab09.css">
</head>
<body>
    <form action="lab09a.php" method="post" enctype="multipart/form-data">
        <h2 style="text-align: center;"> Add New Entry To Existing Table </h2>

        <label for="subject">Subject:</label>
        <input type="text" name="subject" id="subject" required>
        <br>

        <label for="location">Location:</label>
        <input type="text" name="location" id="location" required>
        <br>
        
        <label for="date_taken">Date Taken:</label>
        <input type="date" name="date_taken" id="date_taken" required>
        <br>
        
        <label for="picture_url">Image:</label>
        <input type="file" name="picture_url" id="picture_url" required>
        <br>
        
        <input type="submit" value="Add Entry">
    </form>

    <div id="output">
        <p><a href="lab09b.php">or click to go to table</a></p>
        <p><a href="https://www.cs.ryerson.ca/~aarcaina/">or home</a></p>
    </div>
</body>
</html>