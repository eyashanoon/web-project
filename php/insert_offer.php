<?php
session_start();
if(isset($_POST['form'])){

    $price=$_POST['Fund_Amount']* $_POST['weight_Fund_Amount'];
    $Percentage=$_POST['Percentage'];
    $notes=$_POST['notes'];

    $conn = new mysqli('localhost', 'root', '', 'WebProject');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $date=date("Y-m-d H:i:s");


    if($_SESSION['offer']==1){
        $stmt = $conn->prepare("UPDATE offers SET price=?, percentage=?, notes=?, date=?  WHERE investor_id=? and project_email=?");
        $stmt->bind_param("iissis", $price, $Percentage, $notes, $date, $_SESSION['id'], $_SESSION['userEmail']);
        $stmt->execute();
    }
    elseif($_SESSION['offer']==0){
        $sql="insert into offers (price, percentage, notes, date ,investor_id , project_email) values (".$price.",".$Percentage.",".$notes.",".$date.",".$_SESSION['id'].",".$_SESSION['userEmail'].")";
        error_log($sql);
        $stmt = $conn->prepare("insert into offers (price, percentage, notes, date ,investor_id , project_email) values (?, ?, ?, ?, ?, ?)");
         $stmt->bind_param("iissis", $price, $Percentage, $notes, $date, $_SESSION['id'], $_SESSION['userEmail']);

        $stmt->execute();
    }
    header("location:../html/projectdetals.php");
}



