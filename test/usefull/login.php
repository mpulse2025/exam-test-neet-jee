<?php
$servername = "localhost";
$username = "root";
$password = "mpulse@2025";
$database = "mpulse_login";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email    = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user && password_verify($password, $user['password'])) {
    echo "Login successful!";
} else {
    echo "Invalid email or password.";
}

$stmt->close();
$conn->close();
?>
