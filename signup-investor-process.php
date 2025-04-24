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
        <img src="images/img.png" class="img-center" alt="">
    </div>
    <div class="second-half">
        <div class="tabs-div">
            <div class="project-div-in-investor-sign-up" onclick="window.location.href='signup-project-process.php'">
                <h2>
                    Project
                </h2>
            </div><!--
                --><div class="investor-div-in-investor-sign-up">
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
                    <form method="post" action="signup-investor-process.php" enctype="multipart/form-data">
                        <?php

                        if (isset($_POST['email'])) {
                            $email = $_POST['email'];
                            $password = $_POST['password'];
                            $confirm_password = $_POST['confirm_password'];
                            try {
                                $db = new mysqli('localhost', 'root', '', 'WebProject');
                                $query = "SELECT * FROM investor where email = '$email'";
                                $res = $db->query($query);
                                if($res->num_rows != 0){
                                    echo '<h3><b>Email is already registered as an investor, use another one, or sign in using it.</b></h3>';
                                }
                                else{
                                    $query = "SELECT * FROM project where email = '$email'";
                                    $res = $db->query($query);
                                    if($res->num_rows != 0){
                                        echo '<h3><b>Email is already registered as a project, use another one, or sign in using it.</b></h3>';
                                    }
                                    else{
                                        if ($password != $confirm_password) {
                                            echo '<h3><b>Passwords do not match.</b></h3>';
                                        }
                                        else{

                                            $picture = $_FILES['picture']['tmp_name'];
                                            $qualification_file = $_FILES['qualification_file']['tmp_name'];
                                            $investments_file = $_FILES['investments_file']['tmp_name'];
                                            $real_estate_file = $_FILES['real_estate_file']['tmp_name'];

                                            $pic_ext = pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION);
                                            $qualification_ext = pathinfo($_FILES['qualification_file']['name'], PATHINFO_EXTENSION);
                                            $investments_ext = pathinfo($_FILES['investments_file']['name'], PATHINFO_EXTENSION);
                                            $real_estate_ext = pathinfo($_FILES['real_estate_file']['name'], PATHINFO_EXTENSION);

                                            $picture_name = $email . '.' . $pic_ext;
                                            $qualification_file_name = $email . '.' . $qualification_ext;
                                            $investments_file_name = $email . '.' . $investments_ext;
                                            $real_estate_file_name = $email . '.' . $real_estate_ext;

                                            $image_dir = 'uploads\investor/image/';
                                            $qualification_file_dir = 'uploads\investor/Qualification/';
                                            $investments_file_dir = 'uploads\investor/investments/';
                                            $real_estate_file_dir = 'uploads\investor/real_estate/';

                                            $first_name = $_POST['first_name'];
                                            $last_name = $_POST['last_name'];
                                            $gender = $_POST['gender'];
                                            $birthdate = $_POST['birthdate'];
                                            $qualification = $_POST['qualification'];

                                            $worth = $_POST['worth'];
                                            $worth = (int) $worth;
                                            $worth_x = $_POST['worth_x'];
                                            if($worth_x == "K")
                                                $worth_x = 1000;
                                            else if($worth_x == "M")
                                                $worth_x = 1000000;
                                            else if($worth_x == "B")
                                                $worth_x = 1000000000;
                                            else
                                                $worth_x = 1;
                                            $worth *= $worth_x;

                                            $cash = $_POST['cash'];

                                            $collectables = $_POST['collectables'];
                                            $collectables = (int) $collectables;
                                            $collectables_x = $_POST['collectables_x'];
                                            if($collectables_x == "K")
                                                $collectables_x = 1000;
                                            else if($collectables_x == "M")
                                                $collectables_x = 1000000;
                                            else if($collectables_x == "B")
                                                $collectables_x = 1000000000;
                                            else
                                                $collectables_x = 1;
                                            $collectables *= $collectables_x;

                                            $real_estate = $_POST['real_estate'];
                                            $investments = $_POST['investments'];
                                            $prominent  = $_POST['prominent'];
                                            $phone_number = $_POST['phone_number'];
                                            $investor_experiences = $_POST['investor_experiences'];
                                            $id = NULL;


                                            $insert_query = "INSERT INTO `investor` (`first_name`, `last_name`, `gender`, `birth_date`, `qualification`, `qualification_file`, `total_worth`, `cash`, `collectibles`, `real_estate`, `real_estate_file`, `investments`, `prominent`, `investments_file`, `investor_experiences`, `email`, `password`, `image`, `phone`)
                                                                         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, SHA1(?), ?, ?)";
                                            $stmt = $db->prepare($insert_query);
                                            $stmt->bind_param("ssssisiiiisiisisssi", $first_name, $last_name, $gender, $birthdate, $qualification, $qualification_file_name, $worth, $cash, $collectables, $real_estate, $real_estate_file_name, $investments, $prominent, $investments_file_name, $investor_experiences, $email, $password, $picture_name ,$phone_number);
                                            $stmt->execute();
                                            $stmt->close();

                                            $query = "SELECT * FROM investor where email = '$email'";
                                            $res = $db->query($query);
                                            $res = $res->fetch_assoc();
                                            $id = $res['id'];

                                            $picture_name = $id . '.' . $pic_ext;
                                            $qualification_file_name = $id . '.' . $qualification_ext;
                                            $investments_file_name = $id . '.' . $investments_ext;
                                            $real_estate_file_name = $id . '.' . $real_estate_ext;

                                            $update_query = "UPDATE `investor` SET `qualification_file`  = ?, `real_estate_file` = ?, `investments_file` = ?, `image` = ?  WHERE `investor`.`id` = $id";
                                            $stmt2 = $db->prepare($update_query);
                                            $stmt2->bind_param("ssss", $qualification_file_name, $real_estate_file_name, $investments_file_name, $picture_name);
                                            $stmt2->execute();
                                            $stmt2->close();

                                            move_uploaded_file($picture, $image_dir . $picture_name);
                                            move_uploaded_file($qualification_file, $qualification_file_dir . $qualification_file_name);
                                            move_uploaded_file($investments_file, $investments_file_dir . $investments_file_name);
                                            move_uploaded_file($real_estate_file, $real_estate_file_dir . $real_estate_file_name);

                                            echo '<h4 style="color: blue"> Account registered successfully. You can log in now from the login page.</h4>';
                                        }
                                    }
                                }

                            } catch (Exception $e) {
                                echo '<h3><b>'.$e->getMessage(). $e->getTraceAsString().'</b></h3>';

                            }
                        }

                        ?>
                        <div class="project-signup-user-div">
                            <h2>Password</h2>
                            <p> General Info about your project</p>
                            <div class="project-signup-user-name-div">
                                <p class="project-signup-user-name-p"> Email Address</p>
                                <img src="images/tooltip.png" class="tooltip" title="A valid email for communication and account verification." alt="">
                                <input type="email" name="email" class="project-signup-user-name" required>
                            </div>
                            <div class="project-signup-user-name-div">
                                <p class="project-signup-user-name-p"> New Password </p>
                                <img src="images/tooltip.png" class="tooltip" title="New password to use for this account" alt="">
                                <input type="password" name = "password" class="project-signup-user-name" required>
                            </div>
                            <div class="project-signup-user-name-div">
                                <p class="project-signup-user-name-p"> Confirm Password </p>
                                <img src="images/tooltip.png" class="tooltip" title="Re-type the new password." alt="">
                                <input type="password" name="confirm_password" class="project-signup-user-name" required>
                            </div>
                        </div>
                        <div class="project-signup-user-div">
                            <h2> Personal Info</h2>
                            <div class="project-signup-user-name-div">
                                <p class="project-signup-user-name-p"> Profile Picture: </p>
                                <img src="images/tooltip.png" class="tooltip" title="A picture showing the owner of the account." alt="">
                                <input type="file" name="picture" required class="project-signup-user-name">
                            </div>
                            <div class="project-signup-user-name-div">
                                <p class="project-signup-user-name-p"> First Name </p>
                                <img src="images/tooltip.png" class="tooltip" title="The owner of the account's first name." alt="">
                                <input type="text" name="first_name" class="project-signup-user-name" required>
                            </div>
                            <div class="project-signup-user-name-div">
                                <p class="project-signup-user-name-p"> Last Name </p>
                                <img src="images/tooltip.png" class="tooltip" title="The owner of the account's last name." alt="">
                                <input type="text" name="last_name" class="project-signup-user-name" required>
                            </div>
                            <div class="project-signup-user-name-div">
                                <p class="project-signup-user-name-p"> Gender </p>
                                <img src="images/tooltip.png" class="tooltip" title="The owner of the account's gender." alt="">
                                <label for="genderM" class="gender">Male</label>
                                <input type="radio" name="gender" id="genderM" value="M">
                                <label for="genderF" class="gender">Female</label>
                                <input type="radio" name="gender" id="genderF" value="F">
                            </div>
                            <div class="project-signup-user-name-div">
                                <p class="project-signup-user-name-p"> Birthdate </p>
                                <img src="images/tooltip.png" class="tooltip" title="The owner of the account's birthdate." alt="">
                                <input type="date" name="birthdate" class="project-signup-user-name" required>
                            </div>
                            <div class="project-signup-user-name-div">
                                <p class="project-signup-user-name-p"> Qualification </p>
                                <img src="images/tooltip.png" class="tooltip" title="The qualification the owner of the account has.">
                                <select name="qualification" class="project-signup-user-name">
                                    <option value="0">None</option>
                                    <option value="1">High School</option>
                                    <option value="2">Bachelor's</option>
                                    <option value="3">Master's</option>
                                    <option value="4">Doctorate</option>
                                </select>
                            </div>
                            <div class="project-signup-user-name-div">
                                <p class="project-signup-user-name-p" style="width: 250px"> Qualification file:</p>
                                <img src="images/tooltip.png" class="tooltip" title="The industry in which their project operates (e.g., technology, healthcare, finance)." alt="">
                                <input type="file" name="qualification_file" class="project-signup-user-name" style="width: 300px" required>
                            </div>
                        </div>
                        <div class="project-signup-user-div">
                            <h2> Investor's Worth</h2>
                            <div class="project-signup-user-name-div">
                                <p class="project-signup-user-name-p"> Approximate total of worth </p>
                                <img src="images/tooltip.png" class="tooltip" title="The name of the company holding the project." alt="">
                                <input name="worth" type="number" class="project-signup-user-name" style="width: 300px" required>
                                <select name="worth_x" class="project-signup-user-name" style="height: 25px; width: 250px" required>
                                    <option>-</option>
                                    <option>K</option>
                                    <option>M</option>
                                    <option>B</option>
                                </select>
                            </div>
                            <div class="project-signup-user-name-div" style="display: flow; padding: 10px; border: 1px solid gray; border-radius: 10px">
                                <p class="project-signup-user-name-p" style="width: 100%"> Cash and Valuable collectibles </p>
                                <div class="project-signup-user-name-div">
                                    <p class="project-signup-user-name-p"> Cash % of the total worth</p>
                                    <img src="images/tooltip.png" class="tooltip" title="The industry in which their project operates (e.g., technology, healthcare, finance).">
                                    <input name="cash" type="number" class="project-signup-user-name" required>
                                    %
                                </div>
                                <div class="project-signup-user-name-div">
                                    <p class="project-signup-user-name-p"> Valuable collectibles worth</p>
                                    <img src="images/tooltip.png" class="tooltip" title="The industry in which their project operates (e.g., technology, healthcare, finance)." alt="">
                                    <input name="collectables" type="number" class="project-signup-user-name" style="width: 300px" required>
                                    <select name="collectables_x" class="project-signup-user-name" style="height: 25px; width: 250px" required>
                                        <option>-</option>
                                        <option>K</option>
                                        <option>M</option>
                                        <option>B</option>
                                    </select>
                                </div>
                            </div>
                            <div class="project-signup-user-name-div" style="display: flow; padding: 10px; border: 1px solid gray; border-radius: 10px">
                                <p class="project-signup-user-name-p" style="width: 100%"> Real Estate </p>
                                <div class="project-signup-user-name-div">
                                    <p class="project-signup-user-name-p"> Real Estate % of total worth:</p>
                                    <img src="images/tooltip.png" class="tooltip" title="The industry in which their project operates (e.g., technology, healthcare, finance).">
                                    <input name="real_estate" type="number" class="project-signup-user-name" required>
                                    %
                                </div>
                                <div class="project-signup-user-name-div">
                                    <p class="project-signup-user-name-p" style="width: 250px"> Files documenting part of these properties:</p>
                                    <img src="images/tooltip.png" class="tooltip" title="The industry in which their project operates (e.g., technology, healthcare, finance)." alt="">
                                    <input name="real_estate_file" type="file" class="project-signup-user-name" style="width: 300px" required>
                                </div>
                            </div>
                            <div class="project-signup-user-name-div" style="display: flow; padding: 10px; border: 1px solid gray; border-radius: 10px">
                                <p class="project-signup-user-name-p" style="width: 100%"> Investments </p>
                                <div class="project-signup-user-name-div">
                                    <p class="project-signup-user-name-p"> Investments % of total worth:</p>
                                    <img src="images/tooltip.png" class="tooltip" title="The industry in which their project operates (e.g., technology, healthcare, finance)." alt="">
                                    <input name="investments" type="number" class="project-signup-user-name" required>
                                    %
                                </div>
                                <div class="project-signup-user-name-div">
                                    <p class="project-signup-user-name-p" style="width: 250px"> Names of prominent investment firms:</p>
                                    <img src="images/tooltip.png" class="tooltip" title="The industry in which their project operates (e.g., technology, healthcare, finance)." alt="">
                                    <input name="prominent" type="text" class="project-signup-user-name" required>
                                </div>
                                <div class="project-signup-user-name-div">
                                    <p class="project-signup-user-name-p" style="width: 250px"> Files documenting part of these investments:</p>
                                    <img src="images/tooltip.png" class="tooltip" title="The industry in which their project operates (e.g., technology, healthcare, finance).">
                                    <input name="investments_file" type="file" class="project-signup-user-name" style="width: 300px" required>
                                </div>
                            </div>
                        </div>
                        <div class="project-signup-user-div">
                            <h2> Contact info</h2>
                            <p> Info needed to help investors make contact with project owner(s)</p>
                            <div class="project-signup-user-name-div">
                                <p class="project-signup-user-name-p"> Phone Number </p>
                                <img src="images/tooltip.png" class="tooltip" title="For additional contact options.">
                                <input name="phone_number" type="text" class="project-signup-user-name" required>
                            </div>
                        </div>
                        <div class="project-signup-user-div">
                            <h2> Investor's Life Experiences</h2>
                            <div class="project-signup-user-name-div">
                                <textarea name="investor_experiences" class="project-signup-textarea" style="width: 600px"></textarea>
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