<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "camera_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Update the dealer_details table
$sql = "UPDATE dealer_details SET web_server_ip = 'localhost:4500'";

if ($conn->query($sql) === TRUE) {
    echo "Successfully updated the web_server_ip to localhost:4500\n";
} else {
    echo "Error updating record: " . $conn->error . "\n";
}

$conn->close();
?>
