<?php
session_start();

if(isset($_POST['form1'])){
    $targetDirectory1 = "../uploads/investor/Qualification/";
    $targetDirectory2 = "../uploads/investor/Image/";

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $birth_day = $_POST['birth_day'];
    $qualification = $_POST['qualification'];

    $id = $_SESSION['id'];

    $conn = new mysqli('localhost', 'root', '', 'WebProject');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("UPDATE investor SET first_name=?, last_name=?, birth_date=?, gender=?, qualification=? WHERE id=?");
    $stmt->bind_param("sssssi", $first_name, $last_name, $birth_day, $gender, $qualification, $id);
    $stmt->execute();


    if( isset($_FILES['qualification_file']['name']) && $_FILES['qualification_file']['name'] != '') {
        $fileName1 = $_FILES["qualification_file"]["name"];
        $fileSize1 = $_FILES["qualification_file"]["size"];
        $fileTmpName1 = $_FILES["qualification_file"]["tmp_name"];
        $fileType1 = $_FILES["qualification_file"]["type"];
        $fileExtension1 = strtolower(pathinfo($fileName1, PATHINFO_EXTENSION));
        $fileUniqueName1 = $_SESSION['id'] . '.' . $fileExtension1;
        $targetPath1 = $targetDirectory1 . $fileUniqueName1;
        move_uploaded_file($fileTmpName1, $targetPath1);

        $stmt = $conn->prepare("UPDATE investor SET   qualification_file=? WHERE id=?");
        $stmt->bind_param("si",  $fileUniqueName1,  $id);
        $stmt->execute();
    }
    if(isset($_FILES["image"]["name"])&&$_FILES["image"]["name"]!='') {
        $fileName2 = $_FILES["image"]["name"];
        $fileSize2 = $_FILES["image"]["size"];
        $fileTmpName2 = $_FILES["image"]["tmp_name"];
        $fileType2 = $_FILES["image"]["type"];
        $fileExtension2 = strtolower(pathinfo($fileName2, PATHINFO_EXTENSION));
        $fileUniqueName2 = $_SESSION['id'] . '.' . $fileExtension2;
        $targetPath2 = $targetDirectory2 . $fileUniqueName2;
        $prefile= glob($targetDirectory2 .$_SESSION['id'] . '.*');

        if (!empty($prefile)) {
            foreach ($prefile as $filePath) {
                // Check if the file exists and delete it
                if (file_exists($filePath)) {
                    unlink($filePath);
                     }
                }
            }
        move_uploaded_file($fileTmpName2, $targetPath2);
        $stmt = $conn->prepare("UPDATE investor SET   image=? WHERE id=?");
        $stmt->bind_param("si",  $fileUniqueName2,  $id);
        $stmt->execute();

    }




        if ($stmt->error) {
            echo "Error updating record: " . $stmt->error;
        } else {
            echo "Record updated successfully";
        }

        $stmt->close();
        $conn->close();


     header("Location: " . $_SERVER['HTTP_REFERER']."#ff");



}

elseif (isset($_POST['form2'])) {
    $targetDirectory1 = "../uploads/investor/real_estate/";
    $targetDirectory2 = "../uploads/investor/investments/";

    $total_worth = $_POST['total_worth'];
    $weight_total_worth = $_POST['weight_total_worth'];
    $cash = $_POST['cash'];
    $collectibles = $_POST['collectibles'];
    $weight_collectibles = $_POST['weight_collectibles'];
    $real_estate = $_POST['real_estate'];
    $investments = $_POST['investments'];
    $name_investment = $_POST['name_investment'];
     $investments_file_tmp = $_FILES["investments_file"]["tmp_name"];
    $total_worth *= $weight_total_worth;
    $collectibles *= $weight_collectibles;
    if (($cash + $investments + $real_estate) >= 99) header("location:../html/InvesterInfo.php");
    $id = $_SESSION['id'];

    $conn = new mysqli('localhost', 'root', '', 'WebProject');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $stmt = $conn->prepare(" UPDATE investor SET total_worth=?, cash=?, collectibles=?, real_estate=?, investments=?, prominent=?  WHERE id=?");
    $stmt->bind_param("iiiiisi", $total_worth, $cash, $collectibles, $real_estate, $investments, $name_investment, $id);

    $stmt->execute();

    if(isset($_FILES["real_estate_file"]["name"])&&$_FILES["real_estate_file"]["name"]!='') {
        $fileName1 = $_FILES["real_estate_file"]["name"];
        $fileSize1 = $_FILES["real_estate_file"]["size"];
        $fileTmpName1 = $_FILES["real_estate_file"]["tmp_name"];
        $fileType1 = $_FILES["real_estate_file"]["type"];
        $fileExtension1 = strtolower(pathinfo($fileName1, PATHINFO_EXTENSION));
        $fileUniqueName1 = $_SESSION['id'] . '.' . $fileExtension1;
        $targetPath1 = $targetDirectory1 . $fileUniqueName1;
        move_uploaded_file($fileTmpName1, $targetPath1);
        $stmt = $conn->prepare(" UPDATE investor SET  real_estate_file=?  WHERE id=?");
        $stmt->bind_param("si" ,$fileUniqueName1, $id);

        $stmt->execute();

    }


   if(isset( $_FILES["investments_file"]["name"])&&$_FILES["investments_file"]["name"]!='') {
       $fileName2 = $_FILES["investments_file"]["name"];
       $fileSize2 = $_FILES["investments_file"]["size"];
       $fileTmpName2 = $_FILES["investments_file"]["tmp_name"];
       $fileType2 = $_FILES["investments_file"]["type"];
       $fileExtension2 = strtolower(pathinfo($fileName2, PATHINFO_EXTENSION));
       $fileUniqueName2 = $_SESSION['id'] . '.' . $fileExtension2;
       $targetPath2 = $targetDirectory2 . $fileUniqueName2;
       move_uploaded_file($fileTmpName2, $targetPath2);
       $stmt = $conn->prepare(" UPDATE investor SET investments_file=? WHERE id=?");
       $stmt->bind_param("si", $fileUniqueName2, $id);

       $stmt->execute();
   }


        if ($stmt->error) {
            echo "Error updating record: " . $stmt->error;
        } else {
            echo "Record updated successfully";
        }

        $stmt->close();
        $conn->close();

    header("Location: " . $_SERVER['HTTP_REFERER']."#sf");


}
elseif (isset($_POST['form3'])){
    $investor_experiences=$_POST['investor_experiences'];
    $id = $_SESSION['id'];
    $conn = new mysqli('localhost', 'root', '', 'WebProject');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $stmt = $conn->prepare(" UPDATE investor SET Investor_experiences=? WHERE id=?");
    $stmt->bind_param("si", $investor_experiences,$id);

    $stmt->execute();

    if($stmt->error) {
        echo "Error updating record: " . $stmt->error;
    } else {
        echo "Record updated successfully";
    }

    $stmt->close();
    $conn->close();

     header("Location: " . $_SERVER['HTTP_REFERER']."#tf");


}
elseif (isset($_POST['form4'])){
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $id = $_SESSION['id'];
    $conn = new mysqli('localhost', 'root', '', 'WebProject');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    if(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL)) {
        $stmt = $conn->prepare(" UPDATE investor SET email=?,phone=?,password=SHA1(?) WHERE id=?");
        $stmt->bind_param("sssi", $email, $phone, $password, $id);

        $stmt->execute();

        if ($stmt->error) {
            echo "Error updating record: " . $stmt->error;
        } else {
            echo "Record updated successfully";
        }

        $stmt->close();
        $conn->close();
    }
    else{
        header("location:../html/InvestorInfo.php");
    }
     header("Location: " . $_SERVER['HTTP_REFERER']."#frthf");


}
exit();

