<?php
session_start();
if($_SESSION['type'] != 'project')
    header('location:index.php');
$email = $_SESSION['id'];
$db = new mysqli('localhost', 'root', '', 'WebProject');
$query = "SELECT * FROM project where email = '$email'";
$res = $db->query($query);
$res = $res->fetch_assoc();
if(isset($_POST['save'])){
    $new_email = $_POST['email'];

    $password = $res['password'];
    if(isset($_POST['password'])){
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        if($password != $confirm_password){
            echo "<script>alert('Passwords do not match');</script>";
            header('refresh:0;url:index.php');
        }
    }

    $new_picture = $_FILES['new_picture']['tmp_name'];
    if(is_uploaded_file($new_picture)){
        $pic_ext = pathinfo($_FILES['new_picture']['name'], PATHINFO_EXTENSION);
        $picture_name = $new_email . '.' . $pic_ext;
        $pic_dir = 'uploads\project/pictures/';
        move_uploaded_file($new_picture, $pic_dir . $picture_name);
    }
    else
        $picture_name = $res['picture'];

    $new_plan = $_FILES['new_plan']['tmp_name'];
    if(is_uploaded_file($new_plan)){
        $plan_ext = pathinfo($_FILES['new_plan']['name'], PATHINFO_EXTENSION);
        $plan_name = $new_email . '.' . $plan_ext;
        $plan_dir = 'uploads\project/business_plan/';
        move_uploaded_file($new_plan, $plan_dir . $plan_name);
    }
    else
        $plan_name = $res['business_plan'];

    $new_deck = $_FILES['new_deck']['tmp_name'];
    if(is_uploaded_file($new_deck)){
        $deck_ext = pathinfo($_FILES['new_deck']['name'], PATHINFO_EXTENSION);
        $deck_name = $new_email . '.' . $deck_ext;
        $deck_dir = 'uploads\project/pitch_deck/';
        move_uploaded_file($new_deck, $deck_dir . $deck_name);
    }
    else
        $deck_name = $res['pitch_deck'];

    $new_doc = $_FILES['new_doc']['tmp_name'];
    if(is_uploaded_file($new_doc)){
        $doc_ext = pathinfo($_FILES['new_doc']['name'], PATHINFO_EXTENSION);
        $doc_name = $new_email . '.' . $doc_ext;
        $doc_dir = 'uploads\project/legal_docs/';
        move_uploaded_file($new_doc, $doc_dir . $doc_name);
    }
    else
        $doc_name = $res['legal_doc'];

    $new_video = $_FILES['new_video']['tmp_name'];
    if(is_uploaded_file($new_video)){
        $video_ext = pathinfo($_FILES['new_video']['name'], PATHINFO_EXTENSION);
        $video_name = $new_email . '.' . $video_ext;
        $video_dir = 'uploads\project/videos/';
        move_uploaded_file($new_video, $video_dir . $video_name);
    }
    else
        $video_name = $res['video_ver'];


    $name = $_POST['name'];
    $description = $_POST['description'];
    $stage = $_POST['stage'];
    $fund_goal = $_POST['fund_goal'];
    $fund_use = $_POST['fund_use'];
    $company_name = $_POST['company_name'];
    $industry = $_POST['industry'];
    $website_url = $_POST['website_url'];
    $phone_number = $_POST['phone_number'];
    $market_analysis = $_POST['market_analysis'];
    $revenue_model = $_POST['revenue_model'];
    $milestones = $_POST['milestones'];
    $expected_timeline = $_POST['expected_timeline'];
    $legal_entity = $_POST['legal_entity'];
    $location = $_POST['location'];
    $value = $_POST['value'];
    $type = $_POST['type'];
    $value_x = $_POST['value_x'];
    if($value_x == "K")
        $value_x = 1000;
    else if($value_x == "M")
        $value_x = 1000000;
    else if($value_x == "B")
        $value_x = 1000000000;
    $value = $value_x * $value;
    $percentage = $_POST['percentage'];
    $asking = $_POST['asking'];
    $asking_x = $_POST['asking_x'];

    if($asking_x == "K")
        $asking_x = 1000;
    else if($asking_x == "M")
        $asking_x = 1000000;
    else if($asking_x == "B")
        $asking_x = 1000000000;
    $asking = $asking_x * $asking;

    $update_query = "UPDATE `project` SET `email` = ?, `password` = SHA1(?), `picture` = ?, `name` = ?, `description` = ?, `stage` = ?, `fund_goal` = ?, `fund_use`  = ?, `company_name` = ?, `industry` = ?, `website_url` = ?, `phone_number` = ?, `business_plan` = ?, `pitch_deck` = ?, `market_analysis` = ?, `revenue_model` = ?, `legal_doc` = ?, `video_ver` = ?, `milestones` = ?, `expected_timeline` = ?, `legal_entity` = ?, `location` = ?, `project_value` = ?, `type` = ?, `equity_percentage` = ?, `asking_for` = ? WHERE `email` = ?";
    $stmt = $db->prepare($update_query);
    $stmt->bind_param("ssssssissssissssssssssisiis", $new_email, $password, $picture_name, $name, $description, $stage, $fund_goal, $fund_use, $company_name, $industry, $website_url, $phone_number, $plan_name, $deck_name, $market_analysis, $revenue_model, $doc_name, $video_name, $milestones, $expected_timeline, $legal_entity, $location, $value, $type, $percentage, $asking, $email);
    $stmt->execute();
    $stmt->close();
    echo "<script>alert('Date updated!');</script>";
    $_SESSION['id'] = $new_email;
    header('location:project-info-edit.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="CSS/project-page.css"><link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <script>
    </script>
</head>

<body style="overflow: auto">
<div class="page">
    <div class="head" style="min-width: 1000px">
        <div class="logo" onclick="window.location = 'index.php'"><img src="images/img.png" ></div>
        <ul>
            <li><a href="project-info-edit.php">Project Info</a></li>
            <li><a href="project-page.php">Home</a></li>
            <li><a href= "log-out.php">Log Out</a></li>
        </ul>
    </div>
    <div class="center" style="margin-top: 10px; margin-left: 50px; min-width: 1000px">
        <div class="content" id="content">
            <div class="edit-info-div">
                <h1 class="edit-info-h1"> Change Project/Owner(s) Info </h1>
                <p class="edit-info-p"> Allows you to change information of your project</p>
                <form name = "form" action="project-info-edit.php" method="post" enctype="multipart/form-data">
                    <div class="edit-info-user-div" style="display: flex; justify-content: center">
                        <input type="submit" value="Save Changes" class="edit-info-buttons" name="save">
                        <input type="button" value="Cancel" class="edit-info-buttons" onclick="history.back()">
                    </div>
                    <div class="edit-info-user-div">
                        <h2> Project info</h2>
                        <p> General Info about your project</p>
                        <div class="edit-info-user-name-div">
                            <p class="edit-info-user-name-p"> Project Picture </p>
                            <img src="images/tooltip.png" class="tooltip" title="A picture showing the project or project logo">
                            <div style="display: flex">
                                <?php  echo '<img name = "cur_picture" style = "height: 200px; width: 200px; margin-left: 50px" src="uploads/project/pictures/'. $res['picture'] .'">' ?>
                                <p style="margin-top: 100px; margin-left: 100px"> or choose a new image:</p>
                                <input style="margin-top: 100px; margin-left: 10px" type="file"  name = "new_picture"class="project-signup-user-name" accept="image/jpg, image/jpeg, image/png">
                            </div>
                        </div>
                        <div class="edit-info-user-name-div">
                            <p class="edit-info-user-name-p"> Project Name </p>
                            <img src="images/tooltip.png" class="tooltip" title="The name of the project.">
                            <input name = "name" type="text" class="edit-info-user-name" required value="<?php echo $res['name']?>">
                        </div>
                        <div class="edit-info-user-name-div">
                            <p class="edit-info-user-name-p"> Project Description </p>
                            <img src="images/tooltip.png" class="tooltip" title="A brief overview of the project, including its goals and objectives.">
                            <textarea name = "description" class="edit-info-user-name" required ><?php echo $res['description']?></textarea>
                        </div>
                        <div class="edit-info-user-name-div">
                            <p class="edit-info-user-name-p"> Project Type </p>
                            <img src="images/tooltip.png" class="tooltip" title="Current stage of the project (e.g., idea, prototype, growth, scaling).">
                            <select name="type" class="edit-info-user-name" required>
                                <option>---</option>
                                <option>Technology</option>
                                <option>Engineering</option>
                                <option>Construction</option>
                                <option>Healthcare</option>
                                <option>Education</option>
                                <option>Environmental</option>
                                <option>Social and Community</option>
                                <option>Arts and Culture</option>
                                <option>Business</option>
                                <option>Research</option>
                                <option>Innovation</option>
                                <option>Public Sector</option>
                                <option>Government</option>
                                <option>Financial</option>
                                <option>Manufacturing and Industrial</option>
                                <option selected><?php echo $res['type']?></option>
                                <option>Others</option>
                            </select>
                        </div>
                        <div class="edit-info-user-name-div">
                            <p class="edit-info-user-name-p"> Project Value </p>
                            <img src="images/tooltip.png" class="tooltip" title="Current stage of the project (e.g., idea, prototype, growth, scaling).">
                            <input name = "value" type="number" style="width: 1020px" class="edit-info-user-name" required value="<?php
                            $val = $res['project_value'];
                            $x = 0;
                            if($val >= 1000000000){
                                $val = $val / 1000000000;
                                $x = 'B';
                            }
                            else if($val >= 1000000){
                                $val = $val / 1000000;
                                $x = 'M';
                            }
                            else if($val >= 1000){
                                $val = $val / 1000;
                                $x = 'K';
                            }
                            echo $val;
                            ?>">
                            <select name="value_x" class="project-signup-user-name" style="height: 25px; width: 150px" required>
                                <option selected> <?php echo $x?></option>
                                <option>-</option>
                                <option>K</option>
                                <option>M</option>
                                <option>B</option>
                            </select>$
                        </div>
                        <div class="edit-info-user-name-div">
                            <p class="edit-info-user-name-p"> Project Stage </p>
                            <img src="images/tooltip.png" class="tooltip" title="Current stage of the project (e.g., idea, prototype, growth, scaling).">
                            <input name = "stage" type="text" class="edit-info-user-name" required value="<?php echo $res['stage']?>">
                        </div>
                        <div class="edit-info-user-name-div">
                            <p class="edit-info-user-name-p"> Funding Goal </p>
                            <img src="images/tooltip.png" class="tooltip" title="The amount of funding the project owner is seeking.">
                            <input name="fund_goal" type="number" class="edit-info-user-name" required value=<?php echo ((int)$res['fund_goal']); ?>>$
                        </div>
                        <div class="edit-info-user-name-div">
                            <p class="edit-info-user-name-p"> Use of Fund </p>
                            <img src="images/tooltip.png" class="tooltip" title="How the project owner plan to use the funds (e.g., product development, marketing, hiring).">
                            <input name="fund_use" type="text" class="edit-info-user-name" required value="<?php echo $res['fund_use']?>">
                        </div>
                        <div class="edit-info-user-name-div">
                            <p class="edit-info-user-name-p"> Asking for </p>
                            <img src="images/tooltip.png" class="tooltip" title="Current stage of the project (e.g., idea, prototype, growth, scaling).">
                            <input name = "asking" type="number" style="width: 1020px" class="edit-info-user-name" required value="<?php
                            $val = $res['asking_for'];
                            $x = 0;
                            if($val >= 1000000000){
                                $val = $val / 1000000000;
                                $x = 'B';
                            }
                            else if($val >= 1000000){
                                $val = $val / 1000000;
                                $x = 'M';
                            }
                            else if($val >= 1000){
                                $val = $val / 1000;
                                $x = 'K';
                            }
                            echo $val;
                            ?>">
                            <select name="asking_x" class="project-signup-user-name" style="height: 25px; width: 150px" required>
                                <option selected> <?php echo $x?></option>
                                <option>-</option>
                                <option>K</option>
                                <option>M</option>
                                <option>B</option>
                            </select>$
                        </div>
                        <div class="edit-info-user-name-div">
                            <p class="edit-info-user-name-p"> Equity Percentage </p>
                            <img src="images/tooltip.png" class="tooltip" title="The amount of funding the project owner is seeking.">
                            <input name="percentage" type="number" class="edit-info-user-name" required value=<?php echo ((int)$res['equity_percentage']); ?>> %
                        </div>
                    </div>
                    <div class="edit-info-user-div">
                        <h2> Professional info</h2>
                        <p> General Info about your project</p>
                        <div class="edit-info-user-name-div">
                            <p class="edit-info-user-name-p"> Company Name </p>
                            <img src="images/tooltip.png" class="tooltip" title="The name of the company holding the project.">
                            <input name="company_name" type="text" class="edit-info-user-name" required value="<?php echo $res['company_name']?>">
                        </div>
                        <div class="edit-info-user-name-div">
                            <p class="edit-info-user-name-p"> Industry </p>
                            <img src="images/tooltip.png" class="tooltip" title="The industry in which their project operates (e.g., technology, healthcare, finance).">
                            <input name="industry" type="text" class="edit-info-user-name" required value="<?php echo $res['industry']?>">
                        </div>
                        <div class="edit-info-user-name-div">
                            <p class="edit-info-user-name-p"> Website URL </p>
                            <img src="images/tooltip.png" class="tooltip" title="If exists." >
                            <input name="website_url" type="text" class="edit-info-user-name" value="<?php echo $res['website_url']?>">
                        </div>
                    </div>
                    <div class="edit-info-user-div">
                        <h2> Contact info</h2>
                        <p> Info needed to help investors make contact with project owner(s)</p>
                        <div class="edit-info-user-name-div">
                            <p class="edit-info-user-name-p"> Email Address</p>
                            <img src="images/tooltip.png" class="tooltip" title="A valid email for communication and account verification.">
                            <input name="email" type="email" class="edit-info-user-name" required value="<?php echo $res['email']?>">
                        </div>
                        <div class="edit-info-user-name-div">
                            <p class="edit-info-user-name-p"> Phone Number </p>
                            <img src="images/tooltip.png" class="tooltip" title="For additional contact options.">
                            <input type="number" class="edit-info-user-name" required name="phone_number" value=<?php echo $res['phone_number']?>>
                        </div>
                    </div>
                    <div class="edit-info-user-div">
                        <h2> Detailed Project Insights</h2>
                        <p> General Info about your project</p>
                        <div class="edit-info-user-name-div">
                            <p class="edit-info-user-name-p"> Business Plan </p>
                            <img src="images/tooltip.png" class="tooltip" title="Business plan or executive summary.">
                            <a style="width: 350px" href="uploads/project/pitch_deck/<?php echo $res['business_plan']?>" download=""><p style="margin-left: 100px; width: 300px"> View file</p></a>
                            <p style="margin-left: 20px; width: 100%"> or choose a new one:</p>
                            <input type="file" class="edit-info-user-name" name="new_plan">
                        </div>
                        <div class="edit-info-user-name-div">
                            <p class="edit-info-user-name-p"> Pitch Deck </p>
                            <img src="images/tooltip.png" class="tooltip" title="Pitch deck to present the project to investors.">
                            <a style="width: 350px" href="uploads/project/pitch_deck/<?php echo $res['pitch_deck']?>" download=""><p style="margin-left: 100px; width: 300px"> View file</p></a>
                            <p style="margin-left: 20px; margin-right: 20px; width: 100%"> or choose a new one:</p>
                            <input type="file" class="edit-info-user-name" name="new_deck">
                        </div>
                        <div class="edit-info-user-name-div">
                            <p class="edit-info-user-name-p"> Market Analysis </p>
                            <img src="images/tooltip.png" class="tooltip" title="Information about the target market and competitors.">
                            <textarea name="market_analysis" class="edit-info-textarea"><?php echo $res['market_analysis']?></textarea>
                        </div>
                        <div class="edit-info-user-name-div">
                            <p class="edit-info-user-name-p"> Revenue Model </p>
                            <img src="images/tooltip.png" class="tooltip" title="The plan to generate revenue (e.g., subscription, one-time purchase, advertising).">
                            <input type="text" name="revenue_model" class="edit-info-user-name" required value="<?php echo $res['revenue_model']?>">
                        </div>
                    </div>
                    <div class="edit-info-user-div">
                        <h2> Legal Info</h2>
                        <p> General Info about your project</p>
                        <div class="edit-info-user-name-div">
                            <p class="edit-info-user-name-p"> Legal Documentation </p>
                            <img src="images/tooltip.png" class="tooltip" title="Any necessary legal documentation proving the legitimacy of the project or company.">
                            <a style="width: 350px" href="uploads/project/pitch_deck/<?php echo $res['legal_doc']?>" download=""><p style="margin-left: 100px; width: 300px"> View file</p></a>
                            <p style="margin-left: 20px; margin-right: 20px; width: 100%"> or choose a new one:</p>
                            <input type="file" class="edit-info-user-name" name="new_doc">
                        </div>
                        <div class="edit-info-user-name-div">
                            <p class="edit-info-user-name-p"> Video Verification </p>
                            <a style="width: 350px" href="uploads/project/pitch_deck/<?php echo $res['video_ver']?>" download=""><p style="margin-left: 100px; width: 300px"> View file</p></a>
                            <p style="margin-left: 20px; margin-right: 20px; width: 100%"> or choose a new one:</p>
                            <input type="file" class="edit-info-user-name" name="new_video" accept=" video/VP8, video/ogg, video/mp4">
                        </div>
                    </div>
                    <div class="edit-info-user-div">
                        <h2> Additional Info</h2>
                        <p> General Info about your project</p>
                        <div class="edit-info-user-name-div">
                            <p class="edit-info-user-name-p"> Milestones Achieved </p>
                            <img src="images/tooltip.png" class="tooltip" title="Key milestones they have already achieved.">
                            <textarea name="milestones" class="edit-info-textarea"><?php echo $res['milestones']?></textarea>
                        </div>
                        <div class="edit-info-user-name-div">
                            <p class="edit-info-user-name-p"> Expected Timeline </p>
                            <img src="images/tooltip.png" class="tooltip" title="Timeline for key future milestones and project completion.">
                            <input name="expected_timeline" type="text" class="edit-info-user-name" value="<?php echo $res['expected_timeline']?>">
                        </div>
                        <div class="edit-info-user-name-div">
                            <p class="edit-info-user-name-p"> Legal Entity </p>
                            <img src="images/tooltip.png" class="tooltip" title="Type of legal entity (e.g., LLC, Corporation, Sole Proprietorship).">
                            <input name="legal_entity" type="text" class="edit-info-user-name" value="<?php echo $res['legal_entity']?>">
                        </div>
                        <div class="edit-info-user-name-div">
                            <p class="edit-info-user-name-p"> Location </p>
                            <img src="images/tooltip.png" class="tooltip" title="Physical location of their business or project headquarters.">
                            <select name="location" class="edit-info-user-name">
                                <option><?php echo $res['location']?></option>
                                <option>Afghanistan</option>
                                <option>Albania</option>
                                <option>Algeria</option>
                                <option>American Samoa</option>
                                <option>Andorra</option>
                                <option>Angola</option>
                                <option>Anguilla</option>
                                <option>Antarctica</option>
                                <option>Antigua and Barbuda</option>
                                <option>Argentina</option>
                                <option>Armenia</option>
                                <option>Aruba</option>
                                <option>Australia</option>
                                <option>Austria</option>
                                <option>Azerbaijan</option>
                                <option>Bahamas</option>
                                <option>Bahrain</option>
                                <option>Bangladesh</option>
                                <option>Barbados</option>
                                <option>Belarus</option>
                                <option>Belgium</option>
                                <option>Belize</option>
                                <option>Benin</option>
                                <option>Bermuda</option>
                                <option>Bhutan</option>
                                <option>Bolivia</option>
                                <option>Bosnia and Herzegovina</option>
                                <option>Botswana</option>
                                <option>Brazil</option>
                                <option>Brunei Darussalam</option>
                                <option>Bulgaria</option>
                                <option>Burkina Faso</option>
                                <option>Burundi</option>
                                <option>Cabo Verde</option>
                                <option>Cambodia</option>
                                <option>Cameroon</option>
                                <option>Canada</option>
                                <option>Cayman Islands</option>
                                <option>Central African Republic</option>
                                <option>Chad</option>
                                <option>Chile</option>
                                <option>China</option>
                                <option>Colombia</option>
                                <option>Comoros</option>
                                <option>Congo</option>
                                <option>Congo, Democratic Republic of the</option>
                                <option>Costa Rica</option>
                                <option>Croatia</option>
                                <option>Cuba</option>
                                <option>Curaçao</option>
                                <option>Cyprus</option>
                                <option>Czechia</option>
                                <option>Denmark</option>
                                <option>Djibouti</option>
                                <option>Dominica</option>
                                <option>Dominican Republic</option>
                                <option>Ecuador</option>
                                <option>Egypt</option>
                                <option>El Salvador</option>
                                <option>Equatorial Guinea</option>
                                <option>Eritrea</option>
                                <option>Estonia</option>
                                <option>Eswatini</option>
                                <option>Ethiopia</option>
                                <option>Fiji</option>
                                <option>Finland</option>
                                <option>France</option>
                                <option>Gabon</option>
                                <option>Gambia</option>
                                <option>Georgia</option>
                                <option>Germany</option>
                                <option>Ghana</option>
                                <option>Greece</option>
                                <option>Grenada</option>
                                <option>Guam</option>
                                <option>Guatemala</option>
                                <option>Guinea</option>
                                <option>Guinea-Bissau</option>
                                <option>Guyana</option>
                                <option>Haiti</option>
                                <option>Honduras</option>
                                <option>Hungary</option>
                                <option>Iceland</option>
                                <option>India</option>
                                <option>Indonesia</option>
                                <option>Iran</option>
                                <option>Iraq</option>
                                <option>Ireland</option>
                                <option>Italy</option>
                                <option>Jamaica</option>
                                <option>Japan</option>
                                <option>Jordan</option>
                                <option>Kazakhstan</option>
                                <option>Kenya</option>
                                <option>Kiribati</option>
                                <option>Korea, Democratic People's Republic of</option>
                                <option>Korea, Republic of</option>
                                <option>Kuwait</option>
                                <option>Kyrgyzstan</option>
                                <option>Lao People's Democratic Republic</option>
                                <option>Latvia</option>
                                <option>Lebanon</option>
                                <option>Lesotho</option>
                                <option>Liberia</option>
                                <option>Libya</option>
                                <option>Liechtenstein</option>
                                <option>Lithuania</option>
                                <option>Luxembourg</option>
                                <option>Madagascar</option>
                                <option>Malawi</option>
                                <option>Malaysia</option>
                                <option>Maldives</option>
                                <option>Mali</option>
                                <option>Malta</option>
                                <option>Marshall Islands</option>
                                <option>Mauritania</option>
                                <option>Mauritius</option>
                                <option>Mexico</option>
                                <option>Micronesia, Federated States of</option>
                                <option>Moldova, Republic of</option>
                                <option>Monaco</option>
                                <option>Mongolia</option>
                                <option>Montenegro</option>
                                <option>Morocco</option>
                                <option>Mozambique</option>
                                <option>Myanmar</option>
                                <option>Namibia</option>
                                <option>Nauru</option>
                                <option>Nepal</option>
                                <option>Netherlands</option>
                                <option>New Zealand</option>
                                <option>Nicaragua</option>
                                <option>Niger</option>
                                <option>Nigeria</option>
                                <option>North Macedonia</option>
                                <option>Norway</option>
                                <option>Oman</option>
                                <option>Pakistan</option>
                                <option>Palau</option>
                                <option>Palestine</option>
                                <option>Panama</option>
                                <option>Papua New Guinea</option>
                                <option>Paraguay</option>
                                <option>Peru</option>
                                <option>Philippines</option>
                                <option>Poland</option>
                                <option>Portugal</option>
                                <option>Qatar</option>
                                <option>Romania</option>
                                <option>Russian Federation</option>
                                <option>Rwanda</option>
                                <option>Saint Kitts and Nevis</option>
                                <option>Saint Lucia</option>
                                <option>Saint Vincent and the Grenadines</option>
                                <option>Samoa</option>
                                <option>San Marino</option>
                                <option>Sao Tome and Principe</option>
                                <option>Saudi Arabia</option>
                                <option>Senegal</option>
                                <option>Serbia</option>
                                <option>Seychelles</option>
                                <option>Sierra Leone</option>
                                <option>Singapore</option>
                                <option>Slovakia</option>
                                <option>Slovenia</option>
                                <option>Solomon Islands</option>
                                <option>Somalia</option>
                                <option>South Africa</option>
                                <option>South Sudan</option>
                                <option>Spain</option>
                                <option>Sri Lanka</option>
                                <option>Sudan</option>
                                <option>Suriname</option>
                                <option>Sweden</option>
                                <option>Switzerland</option>
                                <option>Syrian Arab Republic</option>
                                <option>Taiwan</option>
                                <option>Tajikistan</option>
                                <option>Tanzania, United Republic of</option>
                                <option>Thailand</option>
                                <option>Timor-Leste</option>
                                <option>Togo</option>
                                <option>Tonga</option>
                                <option>Trinidad and Tobago</option>
                                <option>Tunisia</option>
                                <option>Turkey</option>
                                <option>Turkmenistan</option>
                                <option>Tuvalu</option>
                                <option>Uganda</option>
                                <option>Ukraine</option>
                                <option>United Arab Emirates</option>
                                <option>United Kingdom of Great Britain and Northern Ireland</option>
                                <option>United States of America</option>
                                <option>Uruguay</option>
                                <option>Uzbekistan</option>
                                <option>Vanuatu</option>
                                <option>Venezuela</option>
                                <option>Viet Nam</option>
                                <option>Yemen</option>
                                <option>Zambia</option>
                                <option>Zimbabwe</option>
                            </select>
                        </div>
                    </div>
                    <div class="edit-info-user-div">
                        <h2> Change Password</h2>
                        <p> General Info about your project</p>
                        <div class="edit-info-user-name-div">
                            <p class="edit-info-user-name-p"> Password </p>
                            <img src="images/tooltip.png" class="tooltip" title="Password currently used for this account.">
                            <input type="password" class="edit-info-user-name" placeholder="Unchanged" name="password">
                        </div>
                        <div class="edit-info-user-name-div">
                            <p class="edit-info-user-name-p"> Confirm Password </p>
                            <img src="images/tooltip.png" class="tooltip" title="Re-type password.">
                            <input type="password" class="edit-info-user-name" placeholder="Keep empty if you don't wish to change the current password." name="confirm_password">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
