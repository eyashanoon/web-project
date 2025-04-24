<?php
session_start();
$conditions=json_decode(file_get_contents('php://input'), true);
$stat="";

if($conditions['search']!=""){
    $stat=$stat." name like \"%".$conditions['search']."%\" ";
}
if($conditions['min']!="" && $conditions['max']!=''){
    if($stat!="")$stat=$stat." and ";
    $stat=$stat." project_value > ".$conditions['min']." and project_value < ".$conditions['max'];

}
if($conditions['location']){
    if($stat!="")$stat=$stat." and" ;
    $stat=$stat." location = \"".$conditions['location']."\"";
}

if($conditions['type']!=="--"){
    if($stat!="")$stat=$stat." and" ;
    $stat=$stat." type = \"".$conditions['type']."\"";
}


// Create connection
$conn = new mysqli('localhost', 'root', '', 'WebProject');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch employees data
$sql = "SELECT * FROM project ";

if($stat!="")$sql =$sql." where ".$stat;
error_log($sql);

$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while($row1 = $result->fetch_assoc()) {
        $sql = "SELECT * FROM offers where project_email=\"".$row1["email"]."\" and investor_id=".$_SESSION["id"];
        $result1 = $conn->query($sql);

        if($result1->num_rows ==0) {


            $data[] = $row1;
        }

    }
}

echo json_encode($data);

$conn->close();
