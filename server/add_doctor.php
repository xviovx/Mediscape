<?php

$errors = array();

$db = mysqli_connect('localhost', 'root', '', 'mediscape') or die("Failed to connect to the database");

if(isset($_POST['add_doc_btn'])){
    $docName = mysqli_real_escape_string($db, $_POST['doc_name']);
    $docAge = mysqli_real_escape_string($db, $_POST['doc_age']);
    $docGender = mysqli_real_escape_string($db, $_POST['doc_gender']);
    $docRoom = mysqli_real_escape_string($db, $_POST['doc_room']);
    $docEmail = mysqli_real_escape_string($db, $_POST['doc_email']);
    $docNumber = mysqli_real_escape_string($db, $_POST['doc_number']); 
    $docID = mysqli_real_escape_string($db, $_POST['doc_id']);
    $docSpec = mysqli_real_escape_string($db, $_POST['doc_spec']);

    $profileImage = time() . '_' . $_FILES['profileImage']['name'];
    $imageTarget = '../doc_profiles/' . $profileImage;
    move_uploaded_file($_FILES['profileImage']['tmp_name'], $imageTarget);

    //form authentication
    if(empty($docName)){array_push($errors, "Name is required");}
    if(empty($docAge)){array_push($errors, "Age is required");}
    if(empty($docGender)){array_push($errors, "Gender is required");}
    if(empty($docRoom)){array_push($errors, "A room selection is requierd");}
    if(empty($docEmail)){array_push($errors, "An email is required");}
    if(empty($docID)){array_push($errors, "Please choose your doctor ID");}
    if(empty($docSpec)){array_push($errors, "Please choose your specialisation");}

    $doc_check_query = "SELECT * FROM doctors WHERE email = '$docEmail' OR number = '$docNumber' OR doctor_id = '$docID' OR room_number = '$docRoom' LIMIT 1";
    $result = mysqli_query($db, $doc_check_query);
    $doctor = mysqli_fetch_assoc($result);

    //form validataion
    if($doctor){
        if($doctor['email'] === $docEmail){array_push($errors, "Email is already in use");}
        if($doctor['number'] === $docNumber){array_push($errors, "Phone number already in use");}
        if($doctor['doctor_id'] === $docID){array_push($errors, "That ID is already in use");}
        if($doctor['room_number'] === $docID){array_push($errors, "That room is already in use");}
    }

    if(count($errors) == 0){
        $password = md5($pass1);
        $query = "INSERT INTO doctors (names, age, gender, email, number, doctor_id, specialisation, room_number, profile_pic) values ('$docName', '$docAge', '$docGender', '$docEmail', '$docNumber', '$docID', '$docSpec', '$docRoom', '$profileImage')";
        mysqli_query($db, $query);
        $_SESSION['name'] = $docName;
        header("location: ../pages/doctor_list.php");
    }
    
}