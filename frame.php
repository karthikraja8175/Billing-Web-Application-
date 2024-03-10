<!DOCTYPE html>
<html>
     <head>
        <title>flex php file</title>
        <link rel="stylesheet" href="style.css">
     </head>
     <body style="background-color:rgb(201, 201, 202);">
     <img class="thumps" src="images/thumps.jpg">
     <img onclick="window.location.href='frame.html';" class="back1" value="click" src="images/back.png"> 
     <img  onclick="window.location.href='index.html';" class="home1" value="click" src="images/home.png">

<?php
// Connect to MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "alagu";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Insert data into MySQL database
if(isset($_POST['submit'])) {
    $date = $_POST['date'];
    $size = $_POST['size'];
    $cus_name = $_POST['cus_name'];
    $location = $_POST['location'];
    $amount = $_POST['amount'];
    
    $sql = "INSERT INTO frame (date, size, cus_name, location, amount) VALUES ('$date', '$size', '$cus_name', '$location', '$amount')";
    
    if (mysqli_query($conn, $sql)) {
        echo'<div class="billok">';
        echo "DONE";
        echo'<div>';
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Close MySQL connection
mysqli_close($conn);
?>
</body>
</html>