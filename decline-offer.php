<?php
$conn = new mysqli('localhost', 'root', '', 'WebProject');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$offer_id = $_POST['offer_id'];

if ($offer_id) {
    $update_query = "UPDATE `offers` SET `status` = ? WHERE `id` = ?";
    $stmt = $conn->prepare($update_query);
    $x = "n";
    $stmt->bind_param("ss", $x, $offer_id);
    $stmt->execute();
    $stmt->close();
}

$conn->close();
header('Location:project-page.php');
?>
