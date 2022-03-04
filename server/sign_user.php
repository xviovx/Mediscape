<?php

session_start();

$errors = array();

$db = mysqli_connect('localhost', 'root', '', 'mediscape') or die("Failed to connect to the database");

if(isset($_POST['sign_in_btn'])){
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $pass1 = mysqli_real_escape_string($db, $_POST['pass_1']);

    if(empty($email)){array_push($errors, "An email is required");}
    if(empty($pass1)){array_push($errors, "A password is required");}

    if(count($errors) == 0 ){
        $password = md5($pass1);
        $query = "SELECT * FROM receptionists WHERE email = '$email' AND password = '$password'";
        $result = mysqli_query($db, $query);

        if(mysqli_num_rows($result)){
            $_SESSION['email'] = $email;
            header("location: ../pages/landing_page.php");
        } else{
            array_push($errors, "Your credentials are incorrect");
        };
    };
};

?>