<?php
session_start();
if($_SESSION['type']!="project")
    header('location:index.php');
try{

    $investor_id = $_SESSION['investor_id'];
    $offer_id = $_SESSION['offer_id'];
    $project_email = $_SESSION['id'];
    $db = new mysqli('localhost', 'root', '', 'WebProject');
    $offer_query = "SELECT * FROM offers where `id` = '$offer_id'";
    $investor_query = "SELECT * FROM investor where `id` = '$investor_id'";
    $offer_res = $db->query($offer_query);
    $investor_res = $db->query($investor_query);
    $offer_res = $offer_res->fetch_assoc();
    $investor_res = $investor_res->fetch_assoc();
    $status = $offer_res['status'];
    $_SESSION['status'] = '$status';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="CSS/project-page.css"><link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <script src="javaScript/project-offer-details.js"></script>
</head>
<form id="accept_form" method="post" action="accept_offer.php">
    <input type="hidden" name="offer_id" value="<?php echo $offer_id?>">
    <input type="hidden" name="project_email" value="<?php echo $project_email?>">
</form>

<form id="decline_form" method="post" action="decline-offer.php">
    <input type="hidden" name="offer_id" value="<?php echo $offer_id?>">
</form>

<body style="overflow: auto;" onload="loadOffer()">
<div class="page">
    <div class="head">
        <div class="logo" onclick="window.location = 'index.php'"><img src="Images/img.png" ></div>
        <ul>
            <li><a href="project-info-edit.php">Project Info</a></li>
            <li><a href="project-page.php">Home</a></li>
        </ul>
    </div>
    <div class="project-offers-label-div" style="margin-left: 110px; min-width: 1269px">
        <h1 class="project-offers-label">Offer Details</h1>
    </div>
    <div class="project-offer-details-div">
        <div class="project-offer-details-investor-div" id="sidebar">
            <div class="project-offer-details-investor-img-div">
                <img alt="Investor Image" src="uploads\investor/image/<?php echo $investor_res['image']?>" class="project-offer-details-investor-img">
            </div>
            <div class="project-offer-details-investor-info-div">
                <div class="project-offer-details-investor-info-lv2-div">
                    <p class="project-offer-details-investor-info-p1">Name:<br></p>
                    <p class="project-offer-details-investor-info-p2"><?php echo $investor_res['first_name'].'&nbsp'. $investor_res['last_name'] ?></p>
                </div>
                <div class="project-offer-details-investor-info-lv2-div">
                    <p class="project-offer-details-investor-info-p1">Gender:</p>
                    <p class="project-offer-details-investor-info-p2">
                        <?php
                        if($investor_res['gender']=="M")
                            echo "Male";
                        elseif($investor_res['gender']=="F")
                            echo "Female";
                        ?>
                    </p>
                </div>
                <div class="project-offer-details-investor-info-lv2-div">
                    <p class="project-offer-details-investor-info-p1">Email:</p>
                    <p class="project-offer-details-investor-info-p2"> <?php echo $investor_res['email']?> </p>
                </div>
                <div class="project-offer-details-investor-info-lv2-div">
                    <p class="project-offer-details-investor-info-p1">Phone <br> number:</p>
                    <p class="project-offer-details-investor-info-p2" style="margin-top: 48px"> <?php echo $investor_res['phone']?> </p>
                </div>
            </div>
        </div>
        <div class="project-offer-details-offer-div" id="investment-details">
            <div class="project-offer-details-header">
                <h1 class="project-offer-details-h1">Investment Details</h1>
            </div>
            <div class="project-offer-details-offer-details-div">
                <div class="project-offer-details-offer-detail-div">
                    <p class="project-offer-details-offer-detail-p1"> <br>Price: </p>
                    <p class="project-offer-details-offer-detail-p2"> <?php echo $offer_res['price'] ?>$</p>
                </div>

                <div class="project-offer-details-offer-detail-div">
                    <p class="project-offer-details-offer-detail-p1"> <br>Percentage:</p>
                    <p class="project-offer-details-offer-detail-p2"> <?php echo $offer_res['percentage'] ?> %</p>
                </div>
                <div class="project-offer-details-offer-detail-div">
                    <p class="project-offer-details-offer-detail-p1"> <br>Sent At:</p>
                    <p class="project-offer-details-offer-detail-p2">
                        <?php
                        $datetime = $offer_res['date'] ;
                        $datetime = explode(' ', $datetime);
                        $date = $datetime[0];
                        $time = $datetime[1];
                        echo $date .'<br>'. $time;
                        ?>
                    </p>
                </div>
            </div>
            <div class="project-offer-details-comment-div">
                <h1 class="project-offer-details-comment-h1">Investor comment:</h1>
                <p class="project-offer-details-comment-p"><?php echo $offer_res['notes'] ?></p>
            </div>
            <div class="accept-decline" id="accept-decline">
                <button class="accept-decline-buttons" style="color: lime; border: lime 2px solid" onclick='offerAccepted(<?php echo '"'. $offer_id. '", "' . $project_email . '"' ?>)'>Accept Offer</button>
                <button class="accept-decline-buttons" style="color: red; border: red 2px solid;" onclick="offerDeclined()">Decline Offer</button>
            </div>
        </div>
    </div>
    <div class="project-offer-details-investor-expand-shrink-button-div" >
        <button class="project-offer-details-investor-expand-shrink-button" onclick="expShrClicked()" id="expand-shrink-button"> 🡣 </button>
    </div>
    <div class="project-offer-details-investor-more-div" id = 'more-bar'>
        <div style=" justify-content: center">
            <div class="project-offers-label-div" style="margin-left: 160px;margin-top: 50px">
                <h1 class="project-offers-label">Investor Details</h1>
            </div>
            <div class="project-offer-details-investor-more-img-div" style="margin-left: 510px">
                <img src="uploads\investor/image/<?php echo $investor_res['image']?>" alt="pfp" class="project-offer-details-investor-more-img">
            </div>
        </div>
        <div style="display: flex">

            <div class="project-offer-details-investor-more-category-div">
                <h2 class="project-offer-details-investor-more-category-h2"> Personal Info</h2>
                <div class="project-offer-details-investor-more-name-div">
                    <p class="project-offer-details-investor-more-p1"> Name:  </p>
                    <p class="project-offer-details-investor-more-p2"><?php echo $investor_res['first_name'].'&nbsp'. $investor_res['last_name'] ?></p>
                </div>
                <div class="project-offer-details-investor-more-name-div">
                    <p class="project-offer-details-investor-more-p1"> Gender:  </p>
                    <p class="project-offer-details-investor-more-p2">
                        <?php
                        if($investor_res['gender']=="M")
                            echo "Male";
                        elseif($investor_res['gender']=="F")
                            echo "Female";
                        ?>
                    </p>
                </div>
                <div class="project-offer-details-investor-more-name-div">
                    <p class="project-offer-details-investor-more-p1"> Birthdate:  </p>
                    <p class="project-offer-details-investor-more-p2"> <?php echo $investor_res['birth_date']?> </p>
                </div>
                <div class="project-offer-details-investor-more-name-div">
                    <p class="project-offer-details-investor-more-p1"> Qualification:  </p>
                    <p class="project-offer-details-investor-more-p2">
                        <?php
                        switch ($investor_res['qualification']) {
                            case 'N':
                                echo "None";
                                break;
                            case 'M':
                                echo "Master's";
                                break;
                            case 'H':
                                echo "High School";
                                break;
                            case 'D':
                                echo "Doctorate";
                                break;
                            case 'B':
                                echo "Bachelor's";
                                break;
                            default:
                                echo "None";
                        }
                        ?>
                    </p>
                </div>
            </div>


            <div class="project-offer-details-investor-more-category-div">
                <h2 class="project-offer-details-investor-more-category-h2"> Contact Info</h2>
                <div class="project-offer-details-investor-more-name-div">
                    <p class="project-offer-details-investor-more-p1"> Email:  </p>
                    <p class="project-offer-details-investor-more-p2"> <?php echo $investor_res['email']?> </p>
                </div>
                <div class="project-offer-details-investor-more-name-div">
                    <p class="project-offer-details-investor-more-p1"> Phone number:  </p>
                    <p class="project-offer-details-investor-more-p2"> <?php echo $investor_res['phone']?> </p>
                </div>
            </div>


            <div class="project-offer-details-investor-more-category-div">
                <h2 class="project-offer-details-investor-more-category-h2"> Investor's Worth</h2>
                <div class="project-offer-details-investor-more-name-div">
                    <p class="project-offer-details-investor-more-p1"> Approximate total worth:  </p>
                    <p class="project-offer-details-investor-more-p2">
                        <?php
                        $worth = $investor_res['total_worth'];
                        if($worth>=1000)
                            echo $worth/1000 . 'K$';
                        elseif ($worth>=1000000)
                            echo $worth/1000000 . 'M$';
                        elseif ($worth>=1000000000)
                            echo $worth/1000000000 . 'B$';
                        else
                            echo $worth;
                        ?>
                    </p>
                </div>
                <div class="project-offer-details-investor-more-name-div">
                    <p class="project-offer-details-investor-more-p1"> Cash worth:  </p>
                    <p class="project-offer-details-investor-more-p2"> <?php echo $investor_res['cash'] ?> %</p>
                </div>
                <div class="project-offer-details-investor-more-name-div">
                    <p class="project-offer-details-investor-more-p1"> Collectables worth:  </p>
                    <p class="project-offer-details-investor-more-p2">
                        <?php
                        $worth = $investor_res['collectables'];
                        if($worth>=1000)
                            echo $worth/1000 . 'K$';
                        elseif ($worth>=1000000)
                            echo $worth/1000000 . 'M$';
                        elseif ($worth>=1000000000)
                            echo $worth/1000000000 . 'B$';
                        else
                            echo $worth;
                        ?>
                    </p>
                </div>
                <div class="project-offer-details-investor-more-name-div">
                    <p class="project-offer-details-investor-more-p1"> Real estate worth:  </p>
                    <p class="project-offer-details-investor-more-p2"> <?php echo $investor_res['real_estate'] ?> %</p>
                </div>
            </div>


            <div class="project-offer-details-investor-more-category-div" style="margin-right: 50px">
                <h2 class="project-offer-details-investor-more-category-h2"> Investor's Life Experiences</h2>
                <p class="project-offer-details-investor-more-p1"><?php echo $investor_res['investor_experiences'] ?></p>
            </div>
        </div>
    </div>


</div>
</div>
</body>
</html>



<?php
}
catch (Exception $e){

}

?>


