<?php
function addEntry() {
    $hostname = "localhost";
    $username = "YOUR_USERNAME_HERE";
    $password = "YOUR_PASSWORD_HERE";
    $database = "YOUR_DATABASE_HERE";

    $connect = mysqli_connect($hostname, $username, $password, $database);

    if($connect){ echo "<h2 style='text-align: center; margin-top: 10px;'> Problem 1 </h2>"; }
    else{ echo "Connection failed"; }

    $sql = "CREATE TABLE IF NOT EXISTS Photographs (
        picture_number INT AUTO_INCREMENT PRIMARY KEY NOT NULL, 
        subject VARCHAR(255) NOT NULL,
        location VARCHAR(255) NOT NULL,
        date_taken DATE NOT NULL,
        picture_url VARCHAR(500) NOT NULL UNIQUE
    );";

    mysqli_query($connect, $sql);

    $subject = $location = $date_taken = $picture_url = '';

    if (isset($_POST['subject']) && isset($_POST['location']) && isset($_POST['date_taken']) && isset($_FILES['picture_url'])) {
        $query = mysqli_query($connect, "SELECT MAX(picture_number) AS max_number FROM Photographs;");
        $row = mysqli_fetch_assoc($query);
        $max_number = $row['max_number'];

        mysqli_query($connect, "ALTER TABLE Photographs AUTO_INCREMENT = " . ($max_number++));
        
        $upload_dir = 'images/';
        $picture_url = mysqli_real_escape_string($connect, $_FILES['picture_url']['name']);
        $upload_file = $upload_dir . basename($picture_url);

        $query = mysqli_query($connect, "SELECT * FROM Photographs WHERE picture_url = '$upload_file';");
        $exists = mysqli_fetch_assoc($query);

        if ($exists) {
            mysqli_close($connect);
            return false;
        }
        else {
            if(move_uploaded_file($_FILES["picture_url"]["tmp_name"], $upload_file)) {
                echo "<p style='text-align: center;'> File upload successful. </p>";
            } else {
                echo "<p style='text-align: center;'> File upload failed. </p>";
            }

            $subject = mysqli_real_escape_string($connect, $_POST['subject']);
            $location = mysqli_real_escape_string($connect, $_POST['location']);
            $date_taken = mysqli_real_escape_string($connect, $_POST['date_taken']);

            $sql = "INSERT INTO Photographs (subject, location, date_taken, picture_url)
            VALUES ('$subject', '$location', '$date_taken', '$upload_file');";

            mysqli_query($connect, $sql);

            mysqli_close($connect);

            return true;
        }
    }
}

$bool = addEntry();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab09a</title>
    <link rel="stylesheet" href="lab09.css">
</head>
<body>
    <div id="output">
        <?php
        if ($bool) {
            echo "<p>Entry added successfully</p>";
        } elseif (!$bool) {
            echo "<p>There was an error with uploading the photo. The file already exists.</p>";
        }
        ?>

        <p><a href="lab09b.php">Click here to view the table (Lab09b)</a></p>
        <p><a href="lab09.php">Click here to go back to beginning form</a></p>
    </div>
</body>
</html>
