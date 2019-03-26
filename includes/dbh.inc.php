
<?php
$dBServername = "sql2.njit.edu";
$dBUsername = "la92";
$dBPassword = "06CLHiUFj";
$dBName = "la92";

// Create connection
$conn = mysqli_connect($dBServername, $dBUsername, $dBPassword, $dBName);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>
