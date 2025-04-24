<?php
session_start();
if($_SESSION['type'] != 'project')
    header('location:index.php');
try{

    $email = $_SESSION['id'];
    $db = new mysqli('localhost', 'root', '', 'WebProject');
    $query = "SELECT * FROM project where email = '$email'";
    $res = $db->query($query);
    $res = $res->fetch_assoc();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="CSS/project-page.css"><link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
</head>

<body>
<div class="page">
    <div class="head">
        <div class="logo" style="width: 50px;" onclick="window.location = 'index.php'"><img src="Images/img.png" ></div>
        <ul>
            <li><a href="project-info-edit.php">Project Info</a></li>
            <li><a href="project-page.php">Home</a></li>
            <li><a href= "log-out.php">Log Out</a></li>
        </ul>
    </div>
    <div class="center">
        <div class="project-info">
            <div class="coip">
                <div class="ip">
                    <?php  echo '<img src="uploads/project/pictures/'. $res['picture'] .'">' ?>
                </div>
            </div>
            <div class="info">
                <ul class="project-sidebar-ul">
                    <li class="project-sidebar-uli">
                        <p class="project-sidebar-p1">Project name: </p>
                        <p class="project-sidebar-p2"> <?php echo $res['name']?></p>
                    </li>
                    <li class="project-sidebar-uli">
                        <p class="project-sidebar-p1">Project Type:</p>
                        <p class="project-sidebar-p2"><?php echo $res['type']?></p>
                    </li>
                    <li class="project-sidebar-uli">
                        <p class="project-sidebar-p1">Project Value:</p>
                        <p class="project-sidebar-p2"><?php echo $res['project_value']?></p>
                    </li>
                    <li class="project-sidebar-uli">
                        <p class="project-sidebar-p1">Project Stage:</p>
                        <p class="project-sidebar-p2"><?php echo $res['stage']?></p>
                    </li>
                    <li class="project-sidebar-uli">
                        <p class="project-sidebar-p1">Funding Goal:</p>
                        <p class="project-sidebar-p2"><?php echo $res['fund_goal']?></p>
                    </li>
                    <li class="project-sidebar-uli">
                        <p class="project-sidebar-p1">Use of Fund:</p>
                        <p class="project-sidebar-p2"><?php echo $res['fund_use']?></p>
                    </li>
                    <li class="project-sidebar-uli">
                        <p class="project-sidebar-p1">Project Description:</p>
                        <p class="project-sidebar-p2"> <?php echo $res['description']?></p>
                    </li>
                </ul>
            </div>
            <a href="project-info-edit.php">
                <button class="project-change-button">Change Project Info</button>
            </a>
        </div>
        <div class="content" id="content">
            <div class ="projects" id="projects">
                <div class="project-offers-label-div">
                    <h1 class="project-offers-label">Investment Offers</h1>
                </div>
                <div class="all-offers-div">
                    <?php
                    $query2 = "SELECT * FROM offers where `project_email` = '$email'";
                    $res2 = $db->query($query2);
                    if($res2->num_rows == 0){
                        echo
                        "<div style='min-height: 100%; min-width: 100%; display: flex; justify-content: center'><h1> No offers yet... </h1></div>";
                    }
                    foreach($res2 as $offer){
                        $id = $offer['investor_id'];

                        $query3 = "SELECT * FROM `investor` where `id` = '$id'";
                        $res3 = $db->query($query3);
                        $res3 = $res3->fetch_assoc();

                        $first_name = $res3['first_name'];
                        $last_name = $res3['last_name'];
                        $image = $res3['image'];
                        $price = $offer['price'];
                        $percentage = $offer['percentage'];
                        $date = $offer['date'];
                        $offer_id = $offer['id'];
                        $status = $offer['status'];
                        $color = 'gray';
                        if($status == 'y'){
                            $status = 'Accepted';
                            $color = 'green';
                        }
                        else if($status == 'n'){
                            $status = 'Declined';
                            $color = 'red';
                        }
                        else
                            $status = 'Pending';

                        echo '
                        <div class="one-offer-div">
                        <div class="image-in-offers-div">
                            <img class="image-in-offers" src="uploads\investor/image/'. $image .'" alt="sdsdsd">
                        </div>
                        <div class="info-but-img-in-offers">
                            <div class="offer-name-div">
                                <div class="labels-name">'. $first_name . '&nbsp'.$last_name .'</div>
                                <div class="labels-status" style="color:'. $color .'">'. $status .'</div>
                            </div>
                            
                            <div class="info-in-offers-lv2-div">
                                <div class="info-lv2-in-offers" style=" min-width: 200px; margin-top: -20px">
                                    <b>Price:</b>
                                    <p style="margin-top: 5px">
                                        '. $price .' $
                                    </p>
                                </div>
                                <div class="info-lv2-in-offers" style="margin-right: 50px; min-width: 200px; margin-top: -20px">
                                    <b> Percentage: </b>
                                    <p style="margin-top: 5px">
                                        '. $percentage . '&nbsp %' .'
                                    </p>
                                </div>
                                <div class="info-lv2-in-offers" style="margin-right: 50px; min-width: 200px; margin-top: -20px">
                                    <b>Offer Date:</b>
                                    <p style="margin-top: 5px">
                                        '. $date .'
                                    </p>
                                </div>
                                <div class="info-lv2-in-offers" style="margin-right: 50px; min-width: 150px;">
                                    <a href="to-offer-details.php?offer_id='. $offer_id .'&investor_id='. $id .'" style="text-decoration: none; color: black; font-size: 45px" onclick="toDetails()">
                                        🡪
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                        ';
                    }
                    }
                    catch (Exception $e){
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
