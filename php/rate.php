<?php
session_start();
$id=$_SESSION['id'];
$conn = new mysqli('localhost', 'root', '', 'WebProject');
$sql = "SELECT * FROM offers WHERE investor_id =".$id." and  ( status=\"y\" or status=\"n\" )";

$result = $conn->query($sql);
$n1=$result->num_rows;
$sql = "SELECT * FROM offers WHERE investor_id =".$id." and  status=\"y\" ";

$result = $conn->query($sql);
$n2=$result->num_rows;
if($n1!=0)$n=$n2/$n1;
else $n=0;
echo json_encode($n);

