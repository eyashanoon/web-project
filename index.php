<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="CSS/index.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <script src="javaScript/index.js"> </script>
</head>

<body>

<div class="all">
    <div class="img-div">
        <img src="images/img.png" class="img-center">
    </div>
    <div class="second-half">
        <div class="login-div">
            <div class="center-label-div">
                <h1>
                    Log In
                </h1>
            </div>
            <?php
            session_start();
            if(isset($_POST['email']) && isset($_POST['password'])){
                try{
                    $email = $_POST['email'];
                    $password = $_POST['password'];

                    $db = new mysqli('localhost', 'root', '', 'WebProject');

                    $query = "SELECT * FROM investor WHERE email = '$email'";
                    $res = $db->query($query);
                    if($res->num_rows == 1){
                        $row = $res->fetch_assoc();
                        if($row['password'] == SHA1($password)){
                            $_SESSION['id'] = $row['id'];
                            $_SESSION['type'] = 'investor';
                            header('Location:html/home.php');
                            exit();
                        }
                    }
                    else{
                        $query = "SELECT * FROM project WHERE email = '$email'";
                        $res = $db->query($query);
                        if($res->num_rows == 1){
                            $row = $res->fetch_assoc();
                            if($row['password'] == SHA1($password)){
                                $_SESSION['id'] = $email;
                                $_SESSION['type'] = 'project';
                                header('Location: project-page.php');
                                exit();
                            }
                        }
                        else{
                            echo "<h3> <b style='color: red'>No match for account with this email address and password was found. Please try again.</b></h3>";
                        }
                    }

                }catch (Exception $e){
                    echo "<h3> <b style='color: red'>An error occurred. Please try again later.</b></h3>";
                }
            }
            ?>
            <form method="post" action="index.php">
                <div class="text-login-div">
                    <label>
                        <input
                                name="email"
                                type="text"
                                id="email"
                                value="Email address"
                                onblur="emailTextBlur()"
                                onfocus="emailTextFocus()"
                                class="text-login"
                        >
                    </label>
                </div>
                <div class="text-login-div">
                    <label>
                        <input type="text"
                               name="password"
                               id="password"
                               value="Password"
                               onblur="passwordTextBlur()"
                               onfocus="passwordTextFocus()"
                               class="text-login">
                    </label>
                </div>
                <div class="center-label-div">
                    <input type="submit" value="Sign in" class="project-button-sign-in">
                </div>
            </form>
            <div class="no-account">
                No account? Choose one of the below:
            </div>
            <div class="center-label-div">
                <a href="signup-project-process.php">
                    <input type="button" value="Sign up as a project" class="project-button-signup" onclick="">
                </a>
            </div>
            <div class="center-label-div">
                <a href="signup-investor-process.php">
                    <input type="button" value="Sign up as an investor" class="project-button-signup">
                </a>
            </div>
        </div>
    </div>
</div>

</body>
</html>
