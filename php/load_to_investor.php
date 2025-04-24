<?php
session_start();

 $conn = new mysqli('localhost', 'root', '', 'WebProject');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user ID from GET parameter
$userId =$_SESSION['id'] ;

// Prepare and execute SQL query
$sql = "SELECT * FROM `investor` WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $userData = $result->fetch_assoc();
    $userData["password"]="";
     header('Content-Type: application/json');
    echo json_encode($userData);
}
else {
    echo "User not found.";
}

// Close statement and connection
$stmt->close();
$conn->close();
