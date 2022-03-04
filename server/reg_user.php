<?php

session_start();

$errors = array();

$db = mysqli_connect('localhost', 'root', '', 'mediscape') or die("Failed to connect to the database");

if(isset($_POST['register_btn'])){
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $names = mysqli_real_escape_string($db, $_POST['names']);
    $age = mysqli_real_escape_string($db, $_POST['age']);
    $pos = mysqli_real_escape_string($db, $_POST['rank']);
    $gender = mysqli_real_escape_string($db, $_POST['gender']);
    $number = mysqli_real_escape_string($db, $_POST['phone_number']);
    $pass1 = mysqli_real_escape_string($db, $_POST['pass_1']);
    $pass2 = mysqli_real_escape_string($db, $_POST['pass_2']);

    $profileImage = time() . '_' . $_FILES['profileImage']['name'];
    $imageTarget = '../profiles/' . $profileImage;
    move_uploaded_file($_FILES['profileImage']['tmp_name'], $imageTarget);

    //form authentication
    if(empty($email)){array_push($errors, "Email required");}
    if(empty($names)){array_push($errors, "Name & Surname is required");}
    if(empty($age)){array_push($errors, "An age is required");}
    if(empty($pos)){array_push($errors, "A rank selection is required");}
    if(empty($gender)){array_push($errors, "A gender is required");}
    if(empty($number)){array_push($errors, "A phone number is required");}
    if(empty($pass1)){array_push($errors, "A password is required");}
    if($pass1 != $pass2){array_push($errors, "Passwords do not match");}

    $user_check_query = "SELECT * FROM receptionists WHERE email = '$email' OR number = '$number' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    //form validataion
    if($user){
        if($user['email'] === $email){array_push($errors, "Email is already in use");}
        if($user['number'] === $number){array_push($errors, "Phone number already in use");}
    }

    if(count($errors) == 0){
        $password = md5($pass1);
        $query = "INSERT INTO receptionists (names, age, pos, gender, number, email, password, profile_pic) values ('$names', '$age', '$pos', '$gender', '$number', '$email', '$password', '$profileImage')";
        mysqli_query($db, $query);
        $_SESSION['email'] = $email;
        header("location: ../pages/sign_in.php");
    }
    
}