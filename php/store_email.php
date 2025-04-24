<?php
 session_start();

 $data = file_get_contents('php://input');

 $request = json_decode($data, true);

 if (isset($request['email'])) {
     $email =  $request['email'];


         $_SESSION['userEmail'] = $email;
        echo "Email stored in session.". $_SESSION['userEmail'];

} else {
    echo "Email not provided.";
}