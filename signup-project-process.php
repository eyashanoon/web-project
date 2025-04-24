<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="CSS/project-signup.css">
</head>
<body>
<div class="all">
    <div class="img-div">
        <img src="images/img.png" class="img-center">
    </div>
    <div class="second-half">
        <div class="tabs-div">
            <div class="project-div">
                <h2>
                    Project
                </h2>
            </div><!--
                --><div class="investor-div" onclick="window.location.href='signup-investor-process.php'">
                <h2>
                    Investor
                </h2>
            </div>
            <div class="open-tab-div" id="load">
                <div class="center-label-div">
                    <h1>
                        Sign Up
                    </h1>
                </div>
                <div style="display: flex; justify-content: center">
                    <h2> Already have an account? َ</h2>
                    <a href="index.php"><h2> Sign in.</h2></a>
                </div>
                <div class="sign-up-info-div">
                    <form action="signup-project-process.php" method="post" enctype="multipart/form-data">
                        <?php
                        if (isset($_POST['email'])) {
                            $email = $_POST['email'];
                            $password = $_POST['password'];
                            $confirm_password = $_POST['confirm-password'];
                            try {
                                $db = new mysqli('localhost', 'root', '', 'WebProject');
                                $query = "SELECT * FROM project WHERE email = '$email'";
                                $res = $db->query($query);
                                if($res->num_rows != 0){
                                    echo '<h3><b>Email is already registered as a project, use another one, or sign in using it.</b></h3>';
                                }
                                else{
                                    $query = "SELECT * FROM investor WHERE email = '$email'";
                                    $res = $db->query($query);
                                    $res = $db->query($query);
                                    if($res->num_rows != 0){
                                        echo '<h3><b>Email is already registered as an investor, use another one, or sign in using it.</b></h3>';
                                    }
                                    else{
                                        if ($password != $confirm_password) {
                                            echo '<h3><b>Passwords do not match.</b></h3>';
                                        }
                                        else{

                                            $picture = $_FILES['picture']['name'];
                                            $pic_ext = pathinfo($picture, PATHINFO_EXTENSION);
                                            if($pic_ext != "jpg" && $pic_ext != "png" && $pic_ext != "jpeg"){
                                                echo '<h3><b> Choose an image with one of these extensions: jpg, png or jpeg.</b></h3>';
                                            }
                                            else{

                                                $plan = $_FILES['business_plan']['name'];
                                                $deck = $_FILES['pitch_deck']['name'];
                                                $doc = $_FILES['legal_doc']['name'];
                                                $video = $_FILES['video']['name'];

                                                $plan_ext = pathinfo($plan, PATHINFO_EXTENSION);
                                                $deck_ext = pathinfo($deck, PATHINFO_EXTENSION);
                                                $doc_ext = pathinfo($doc, PATHINFO_EXTENSION);
                                                $video_ext = pathinfo($video, PATHINFO_EXTENSION);

                                                $picture_name = $email . '.' . $pic_ext;
                                                $plan_name = $email . '.' . $plan_ext;
                                                $deck_name = $email . '.' . $deck_ext;
                                                $doc_name = $email . '.' . $doc_ext;
                                                $video_name = $email . '.' . $video_ext;

                                                $pic_dir = 'uploads\project/pictures/';
                                                $plan_dir = 'uploads\project/business_plan/';
                                                $deck_dir = 'uploads\project/pitch_deck/';
                                                $doc_dir = 'uploads\project/legal_docs/';
                                                $video_dir = 'uploads\project/videos/';

                                                move_uploaded_file($_FILES['picture']['tmp_name'], $pic_dir . $picture_name);
                                                move_uploaded_file($_FILES['business_plan']['tmp_name'], $plan_dir . $plan_name);
                                                move_uploaded_file($_FILES['pitch_deck']['tmp_name'], $deck_dir . $deck_name);
                                                move_uploaded_file($_FILES['legal_doc']['tmp_name'], $doc_dir . $doc_name);
                                                move_uploaded_file($_FILES['video']['tmp_name'], $video_dir . $video_name);



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
                                                $type = $_POST['type'];
                                                $percentage = $_POST['percentage'];
                                                $value = $_POST['value'];
                                                $value_x = $_POST['value_x'];
                                                $asking = $_POST['asking'];
                                                $asking_x = $_POST['asking_x'];

                                                if($value_x == "K")
                                                    $value_x = 1000;
                                                else if($value_x == "M")
                                                    $value_x = 1000000;
                                                else if($value_x == "B")
                                                    $value_x = 1000000000;
                                                else $value_x = 1;
                                                $value = $value_x * $value;

                                                if($asking_x == "K")
                                                    $asking_x = 1000;
                                                else if($asking_x == "M")
                                                    $asking_x = 1000000;
                                                else if($asking_x == "B")
                                                    $asking_x = 1000000000;
                                                else $asking_x = 1;
                                                $asking = $asking_x * $asking;

                                                $insert_query = "INSERT INTO `project` (`email`, `password`, `picture`, `name`, `description`, `stage`, `fund_goal`, `fund_use`, `company_name`, `industry`, `website_url`, `phone_number`, `business_plan`, `pitch_deck`, `market_analysis`, `revenue_model`, `legal_doc`, `video_ver`, `milestones`, `expected_timeline`, `legal_entity`, `location`, `type`, `project_value`, `asking_for`, `equity_percentage`)
                                                                 VALUES (?, SHA1(?), ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

                                                $stmt = $db->prepare($insert_query);
                                                $stmt->bind_param("ssssssissssisssssssssssiii", $email, $password, $picture_name, $name, $description, $stage, $fund_goal, $fund_use, $company_name, $industry, $website_url, $phone_number, $plan_name, $deck_name, $market_analysis, $revenue_model, $doc_name, $video_name, $milestones, $expected_timeline, $legal_entity, $location, $type, $value, $asking, $percentage);
                                                $stmt->execute();
                                                $stmt->close();
                                                echo '<h4 style="color: blue"> Account registered successfully. You can log in now from the login page.</h4>';

                                            }
                                        }
                                    }
                                }
                            } catch (Exception $e) {
                                echo '<h3><b>'.$e->getMessage().'</b></h3>';

                            }
                        }

                        ?>
                        <div class="project-signup-user-div">
                            <h2>Password</h2>
                            <p> General Info about your project</p>
                            <div class="project-signup-user-name-div">
                                <p class="project-signup-user-name-p"> Email Address</p>
                                <img src="images/tooltip.png" class="tooltip" title="A valid email for communication and account verification.">
                                <input type="email" name = "email" class="project-signup-user-name" required>
                            </div>
                            <div class="project-signup-user-name-div">
                                <p class="project-signup-user-name-p"> New Password </p>
                                <img src="images/tooltip.png" class="tooltip" title="New password to use for this account">
                                <input type="password" name="password" class="project-signup-user-name" required>
                            </div>
                            <div class="project-signup-user-name-div">
                                <p class="project-signup-user-name-p"> Confirm Password </p>
                                <img src="images/tooltip.png" class="tooltip" title="Re-type the new password.">
                                <input type="password" name = "confirm-password" class="project-signup-user-name" required>
                            </div>
                        </div>
                        <div class="project-signup-user-div">
                            <h2> Project info</h2>
                            <p> General Info about your project</p>
                            <div class="project-signup-user-name-div">
                                <p class="project-signup-user-name-p"> Project Picture: </p>
                                <img src="images/tooltip.png" class="tooltip" title="A picture showing the project or project logo">
                                <input type="file"  name = "picture" required class="project-signup-user-name" accept="image/jpg, image/jpeg, image/png">
                            </div>
                            <div class="project-signup-user-name-div">
                                <p class="project-signup-user-name-p"> Project Name </p>
                                <img src="images/tooltip.png" class="tooltip" title="The name of the project.">
                                <input type="text" name = "name" class="project-signup-user-name" required>
                            </div>
                            <div class="project-signup-user-name-div">
                                <p class="project-signup-user-name-p"> Project Description </p>
                                <img src="images/tooltip.png" class="tooltip" title="A brief overview of the project, including its goals and objectives.">
                                <textarea name = "description" class="project-signup-user-name" required></textarea>
                            </div>
                            <div class="project-signup-user-name-div">
                                <p class="project-signup-user-name-p"> Project Type </p>
                                <img src="images/tooltip.png" class="tooltip" title="The amount of funding the project owner is seeking.">
                                <select name="type" class="project-signup-user-name">
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
                                    <option>Others</option>
                                </select>
                            </div>
                            <div class="project-signup-user-name-div">
                                <p class="project-signup-user-name-p"> Project Value </p>
                                <img src="images/tooltip.png" class="tooltip" title="The amount of funding the project owner is seeking.">
                                <input type="number" name = "value" style=" width: 405px" class="project-signup-user-name" required>
                                <select name="value_x" class="project-signup-user-name" style="height: 25px; width: 150px" required>
                                    <option>-</option>
                                    <option>K</option>
                                    <option>M</option>
                                    <option>B</option>
                                </select>$
                            </div>
                            <div class="project-signup-user-name-div">
                                <p class="project-signup-user-name-p"> Project Stage </p>
                                <img src="images/tooltip.png" class="tooltip" title="Current stage of the project (e.g., idea, prototype, growth, scaling).">
                                <input type="text" name = "stage" class="project-signup-user-name" required>
                            </div>
                            <div class="project-signup-user-name-div">
                                <p class="project-signup-user-name-p"> Funding Goal </p>
                                <img src="images/tooltip.png" class="tooltip" title="The amount of funding the project owner is seeking.">
                                <input type="number" name = "fund_goal" class="project-signup-user-name" required>$
                            </div>
                            <div class="project-signup-user-name-div">
                                <p class="project-signup-user-name-p"> Use of Fund </p>
                                <img src="images/tooltip.png" class="tooltip" title="How the project owner plan to use the funds (e.g., product development, marketing, hiring).">
                                <input type="text" name = "fund_use" class="project-signup-user-name" required>
                            </div>
                            <div class="project-signup-user-name-div">
                                <p class="project-signup-user-name-p"> Asking for </p>
                                <img src="images/tooltip.png" class="tooltip" title="The amount of funding the project owner is seeking.">
                                <input type="number" name = "asking" style=" width: 405px" class="project-signup-user-name" required>
                                <select name="asking_x" class="project-signup-user-name" style="height: 25px; width: 150px" required>
                                    <option>-</option>
                                    <option>K</option>
                                    <option>M</option>
                                    <option>B</option>
                                </select>$
                            </div>
                            <div class="project-signup-user-name-div">
                                <p class="project-signup-user-name-p"> Equity Percentage </p>
                                <img src="images/tooltip.png" class="tooltip" title="The amount of funding the project owner is seeking.">
                                <input type="number" name = "percentage" class="project-signup-user-name"required>%
                            </div>
                        </div>
                        <div class="project-signup-user-div">
                            <h2> Professional info</h2>
                            <p> General Info about your project</p>
                            <div class="project-signup-user-name-div">
                                <p class="project-signup-user-name-p"> Company Name </p>
                                <img src="images/tooltip.png" class="tooltip" title="The name of the company holding the project.">
                                <input type="text" name = "company_name" class="project-signup-user-name" required>
                            </div>
                            <div class="project-signup-user-name-div">
                                <p class="project-signup-user-name-p"> Industry </p>
                                <img src="images/tooltip.png" class="tooltip" title="The industry in which their project operates (e.g., technology, healthcare, finance).">
                                <input type="text" name = "industry" class="project-signup-user-name" required>
                            </div>
                            <div class="project-signup-user-name-div">
                                <p class="project-signup-user-name-p"> Website URL </p>
                                <img src="images/tooltip.png" class="tooltip" title="If exists.">
                                <input type="text" name = "website_url" class="project-signup-user-name">
                            </div>
                        </div>
                        <div class="project-signup-user-div">
                            <h2> Contact info</h2>
                            <p> Info needed to help investors make contact with project owner(s)</p>
                            <div class="project-signup-user-name-div">
                                <p class="project-signup-user-name-p"> Phone Number </p>
                                <img src="images/tooltip.png" class="tooltip" title="For additional contact options.">
                                <input type="tel" name = "phone_number" class="project-signup-user-name" required>
                            </div>
                        </div>
                        <div class="project-signup-user-div">
                            <h2> Detailed Project Insights</h2>
                            <p> General Info about your project</p>
                            <div class="project-signup-user-name-div">
                                <p class="project-signup-user-name-p"> Business Plan </p>
                                <img src="images/tooltip.png" class="tooltip" title="Business plan or executive summary.">
                                <input type="file" name = "business_plan" class="project-signup-user-name" required>
                            </div>
                            <div class="project-signup-user-name-div">
                                <p class="project-signup-user-name-p"> Pitch Deck </p>
                                <img src="images/tooltip.png" class="tooltip" title="Pitch deck to present the project to investors.">
                                <input type="file" name = "pitch_deck" class="project-signup-user-name">
                            </div>
                            <div class="project-signup-user-name-div">
                                <p class="project-signup-user-name-p"> Market Analysis </p>
                                <img src="images/tooltip.png" class="tooltip" title="Information about the target market and competitors.">
                                <textarea name = "market_analysis" style="margin-left: 35px" class="project-signup-textarea"></textarea>
                            </div>
                            <div class="project-signup-user-name-div">
                                <p class="project-signup-user-name-p"> Revenue Model </p>
                                <img src="images/tooltip.png" class="tooltip" title="The plan to generate revenue (e.g., subscription, one-time purchase, advertising).">
                                <input type="text" name = "revenue_model" class="project-signup-user-name" required>
                            </div>
                        </div>
                        <div class="project-signup-user-div">
                            <h2> Legal Info</h2>
                            <p> General Info about your project</p>
                            <div class="project-signup-user-name-div">
                                <p class="project-signup-user-name-p"> Legal Documentation </p>
                                <img src="images/tooltip.png" class="tooltip" title="Any necessary legal documentation proving the legitimacy of the project or company.">
                                <input type="file" name = "legal_doc" class="project-signup-user-name" required>
                            </div>
                            <div class="project-signup-user-name-div">
                                <p class="project-signup-user-name-p"> Video Verification </p>
                                <img src="images/tooltip.png" class="tooltip" title="A video showing ">
                                <input type="file" name = "video" class="project-signup-user-name" accept=" video/VP8, video/ogg, video/mp4" required>
                            </div>
                        </div>
                        <div class="project-signup-user-div">
                            <h2> Additional Info</h2>
                            <p> General Info about your project</p>
                            <div class="project-signup-user-name-div">
                                <p class="project-signup-user-name-p"> Milestones Achieved </p>
                                <img src="images/tooltip.png" class="tooltip" title="Key milestones they have already achieved.">
                                <textarea name = "milestones" style="margin-left: 35px" class="project-signup-textarea"></textarea>
                            </div>
                            <div class="project-signup-user-name-div">
                                <p class="project-signup-user-name-p"> Expected Timeline </p>
                                <img src="images/tooltip.png" class="tooltip" title="Timeline for key future milestones and project completion.">
                                <input type="text" name = "expected_timeline" class="project-signup-user-name">
                            </div>
                            <div class="project-signup-user-name-div">
                                <p class="project-signup-user-name-p"> Legal Entity </p>
                                <img src="images/tooltip.png" class="tooltip" title="Type of legal entity (e.g., LLC, Corporation, Sole Proprietorship).">
                                <input type="text" name = "legal_entity" class="project-signup-user-name">
                            </div>
                            <div class="project-signup-user-name-div">
                                <p class="project-signup-user-name-p"> Location </p>
                                <img src="images/tooltip.png" class="tooltip" title="Physical location of their business or project headquarters.">
                                <input type="text" name = "location" class="project-signup-user-name" required>
                            </div>
                        </div>

                        <div class="edit-info-user-div" style="display: flex; justify-content: center">
                            <input type="submit" value="Create Account" class="project-signup-buttons">
                            <input type="reset" value="Reset" class="project-signup-buttons">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>










