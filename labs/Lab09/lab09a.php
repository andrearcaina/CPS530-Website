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

// initial values of the table
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

$sql .= "INSERT INTO Photographs (picture_number, subject, location, date_taken, picture_url)
VALUES ('13','PIRATE!', 'Koper, Slovenia', '2023-08-22', 'images/img13.jpg');";

$sql .= "INSERT INTO Photographs (picture_number, subject, location, date_taken, picture_url)
VALUES ('14','the HIKE!', 'Georgetown, Ontario', '2023-06-30', 'images/hike.jpeg');";

mysqli_multi_query($connect, $sql);

mysqli_close($connect);

function addEntry() {
    $hostname = "localhost";
    $username = "YOUR_USERNAME_HERE";
    $password = "YOUR_PASSWORD_HERE";
    $database = "YOUR_DATABASE_HERE";

    $connect = mysqli_connect($hostname, $username, $password, $database);

    $subject = $location = $date_taken = $picture_url = '';

    if (isset($_POST['subject']) && isset($_POST['location']) && isset($_POST['date_taken']) && isset($_FILES['picture_url'])) {
        $query = mysqli_query($connect, "SELECT MAX(picture_number) AS max_number FROM Photographs;");
        $row = mysqli_fetch_assoc($query);
        $max_number = $row['max_number'];

        mysqli_query($connect, "ALTER TABLE Photographs AUTO_INCREMENT = " . ($max_number++));
        
        $upload_dir = 'images/';
        $picture_url = mysqli_real_escape_string($connect, $_FILES['picture_url']['name']);
        $upload_file = $upload_dir . basename($picture_url);

        // check if the file name is larger than 250 characters
        if (strlen($picture_url) > 250) {
            $text = "<p style='text-align: center; font-size: 1.3rem; font-weight: bold; color: red;'> Upload failed. File name is too long. </p>";
            mysqli_close($connect);
            return [false, $text];
        }

        //check if the file is greater than 10 MB
        if ($_FILES['picture_url']['size'] > 10000000) {
            $text = "<p style='text-align: center; font-size: 1.3rem; font-weight: bold; color: red;'> Upload failed. File is too large. </p>";
            mysqli_close($connect);
            return [false, $text];
        }

        // check if the file extension is not gif, jpeg, jpg, png
        $file_type = strtolower(pathinfo($upload_file, PATHINFO_EXTENSION));
        if ($file_type != 'gif' && $file_type != 'jpeg' && $file_type != 'jpg' && $file_type != 'png') {
            $text = "<p style='text-align: center; font-size: 1.3rem; font-weight: bold; color: red;'> Error, unsupported file type. </p>";
            mysqli_close($connect);
            return [false, $text];
        }
        
        $query = mysqli_query($connect, "SELECT * FROM Photographs WHERE picture_url = '$upload_file';");
        $exists = mysqli_fetch_assoc($query);

        // check if the file exists in the database
        if ($exists) {
            $text = "<p style='text-align: center; font-size: 1.3rem; font-weight: bold; color: red;'> File exists in database. </p>";
            mysqli_close($connect);
            return [false, $text];
        }
        
        // if all checks do not pass, add the file to the database and upload it to the images folder
        if(move_uploaded_file($_FILES["picture_url"]["tmp_name"], $upload_file)) {
            $text = "<p style='text-align: center; font-size: 1.3rem; font-weight: bold; color: red;'> File upload successful. </p>";
        } else {
            $text = "<p style='text-align: center; font-size: 1.3rem; font-weight: bold; color: red;'> File upload failed. </p>";
            mysqli_close($connect);
            return [false, $text];
        }

        $subject = mysqli_real_escape_string($connect, $_POST['subject']);
        $location = mysqli_real_escape_string($connect, $_POST['location']);
        $date_taken = mysqli_real_escape_string($connect, $_POST['date_taken']);

        $sql = "INSERT INTO Photographs (subject, location, date_taken, picture_url)
        VALUES ('$subject', '$location', '$date_taken', '$upload_file');";

        mysqli_query($connect, $sql);

        mysqli_close($connect);

        return [true, $text];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_form'])) {
    $bool = addEntry();
}

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
        
        <input type="submit" value="Add Entry" name="submit_form">
    </form>

    <div id="output">
        <?php
        if (isset($bool)) {
            if ($bool[0]) {
                echo $bool[1];
                echo "<p>Entry added successfully</p>";
            } else {
                echo $bool[1];
            }
        }
        ?>

        <p><a href="lab09b.php">or click to go to table</a></p>
        <p><a href="https://www.cs.ryerson.ca/~aarcaina/">or home</a></p>
    </div>
</body>
</html>