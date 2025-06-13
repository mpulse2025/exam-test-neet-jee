<?php
$servername = "localhost";
$username = "root";
$password = "mpulse@2025"; // Use your DB password
$database = "mpulse_login";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name     = $_POST['name'];
$email    = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Secure hash

$sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $name, $email, $password);

if ($stmt->execute()) {
    echo "Account created successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
