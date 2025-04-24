<?php
session_start();
$email=$_SESSION['userEmail'];
error_log($email);

$conn = new mysqli('localhost', 'root', '', 'WebProject');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


 $sql = " SELECT * FROM `project` WHERE email = \"".$email."\"";

$result1 = $conn->query($sql);
$userData=[];
if ($result1->num_rows > 0) {
    $userData []= $result1->fetch_assoc();

}



$sql=" SELECT * FROM `offers` WHERE project_email = \"".$email."\" and investor_id= \"".$_SESSION['id']."\" ";

$result2 = $conn->query($sql);
 if ($result2->num_rows > 0) {
     $_SESSION['offer']=1;

     $userData []= $result2->fetch_assoc();
}
 else{
     $_SESSION['offer']=0;

 }


header('Content-Type: application/json');
echo json_encode($userData);

// Close statement and connection
 $conn->close();
