<?php
$conn = new mysqli('localhost', 'root', '', 'WebProject');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$offer_id = $_POST['offer_id'];
$project_email = $_POST['project_email'];

if ($offer_id && $project_email) {
    $update_query = "UPDATE `offers` SET `status` = ? WHERE `project_email` = ?";
    $stmt = $conn->prepare($update_query);
    $x = "n";
    $stmt->bind_param("ss", $x, $project_email);
    $stmt->execute();
    $stmt->close();

    $update_query = "UPDATE `offers` SET `status` = ? WHERE `id` = ?";
    $stmt = $conn->prepare($update_query);
    $x = "y";
    $stmt->bind_param("ss", $x, $offer_id);
    $stmt->execute();
    $stmt->close();
}

$conn->close();
header('Location:project-page.php');
?>
