<?php
session_start();

if(isset($_GET['offer_id']) && isset($_GET['investor_id'])) {
    $offer_id = $_GET['offer_id'];
    $investor_id = $_GET['investor_id'];
    $_SESSION['offer_id'] = $offer_id;
    $_SESSION['investor_id'] = $investor_id;
    header('Location: project-offers-details.php');
} else {
    header('Location: project-page.php');
}
exit();
?>