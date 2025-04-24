<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'WebProject');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$data1=[];
$data2=[];
$sql = "SELECT * FROM offers where investor_id=".$_SESSION['id'];
error_log("rrrrrrrr");

$result = $conn->query($sql);
if ($result->num_rows > 0) {


    while($row = $result->fetch_assoc() ) {

        $data1[]=$row;
        $email=$row["project_email"];

        $sql1="SELECT * FROM project where email=\"".$email."\"";
        $result1=$conn->query($sql1);
        $h=$result1->fetch_assoc();
        $data2[]=$h;
    }
    $data=[];

}
$data[]=$data1;

$data[]=$data2;

echo json_encode($data);

$conn->close();

