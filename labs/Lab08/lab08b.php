<?php
function getNumbers() {
    $num1 = '';
    $num2 = '';

    if (isset($_POST['num1']) && isset($_POST['num2'])) {
        $num1 = $_POST['num1'];
        $num2 = $_POST['num2'];
    } 

    if ($num1 < 3 || $num1 > 12 || $num2 < 3 || $num2 > 12) {
        return [$num1, $num2];
    }

    $table = '<div id="multiplication">';
    $table .= '<table>';
    
    for ($i = 1; $i <= $num1; $i++) {
        $table .= '<tr>';
        for ($j = 1; $j <= $num2; $j++) {
            $table .= '<td>' . ($i * $j) . '</td>';
        }
        $table .= '</tr>';
    }
    
    $table .= '</table>';
    $table .= '</div>';

    return $table;
}

$output = getNumbers();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab08 - Problem 2</title>
    
    <link rel="stylesheet" href="lab08.css">
</head>
<body id="php2">
    <section>
        <h2>Problem 2</h2> 
        <?php
        if (!is_array($output)) {
            echo $output;
        } else {
            echo '<p class="error">Please enter valid numbers between 3 and 12.</p>';
            echo "<p class='error'>Instead of \"$output[0]\", try entering 4.</p>";
            echo "<p class='error'>Instead of \"$output[1]\", try entering 7.</p>";
        }
        ?>
        
        <p class="return">
            <a href="lab08.php">Return to the form</a>
        </p>
    </section>
</body>
</html>
